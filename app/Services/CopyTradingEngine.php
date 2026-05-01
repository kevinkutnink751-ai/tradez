<?php

namespace App\Services;

use App\Models\CopyTradeLog;
use App\Models\CopyTradeRelationship;
use App\Models\Mt4Details;
use App\Models\TradeSignal;
use App\Events\TradeSignalDetected;
use Exception;
use Illuminate\Support\Facades\Log;

class CopyTradingEngine
{
    /**
     * Listen for new trades/signals from master accounts.
     */
    public function monitorMasterAccount(int $masterAccountId): void
    {
        // Fetch the master account from the database
        $master = \App\Models\MasterAccount::find($masterAccountId);
        if (!$master || !$master->is_active) {
            return;
        }

        // Internal trade fetching logic (e.g. from a local buffer or a dedicated table)
        // For now, we assume signals are already pushed to TradeSignal table via some other internal process.
        // Or we could implement a check here if we have a way to talk to MT4 locally.
    }

    /**
     * Check if a trade signal already exists in our database.
     */
    private function tradeSignalExists(int $masterId, string $externalId): bool
    {
        return TradeSignal::where('master_account_id', $masterId)
            ->where('external_trade_id', $externalId)
            ->exists();
    }

    /**
     * Replicate a trade signal to all linked subscriber accounts.
     */
    public function replicateTradeSignal(TradeSignal $signal): void
    {
        // Find all subscribers copying from this master
        $subscribers = CopyTradeRelationship::where('master_account_id', $signal->master_account_id)
            ->where('status', 'ACTIVE')
            ->get();

        foreach ($subscribers as $link) {
            try {
                $this->copyTradeToSubscriber($signal, $link);
            } catch (Exception $e) {
                Log::error("CopyTradingEngine: Failed to replicate trade to subscriber {$link->subscriber_account_id}: {$e->getMessage()}");
                
                CopyTradeLog::create([
                    'trade_signal_id' => $signal->id,
                    'subscriber_account_id' => $link->subscriber_account_id,
                    'executed_volume' => 0,
                    'executed_price' => 0,
                    'status' => 'FAILED',
                    'error_message' => $e->getMessage(),
                    'copied_at' => now(),
                ]);
            }
        }
    }

    /**
     * Execute the actual copy trade for a specific subscriber.
     */
    private function copyTradeToSubscriber(TradeSignal $signal, CopyTradeRelationship $link): void
    {
        $subscriber = Mt4Details::find($link->subscriber_account_id);
        if (!$subscriber) {
            throw new Exception("Subscriber account not found.");
        }

        $riskSettings = $link->risk_settings ?? [];

        // Step 1: Calculate position size based on subscriber's risk parameters
        $adjustedVolume = $this->calculatePositionSize(
            $signal->volume,
            $riskSettings,
            $subscriber->account_bal ?? 0
        );

        // Step 2: Check risk limits before executing
        if (!$this->isWithinRiskLimits($subscriber, $adjustedVolume, $signal)) {
            throw new Exception('Trade exceeds risk limits for subscriber.');
        }

        // Step 3: Execute trade on subscriber's MT4 account
        // Since we are not using an external API, we assume there's an internal bridge or 
        // we just log the intention for now.
        // TODO: Implement local MT4 bridge or manager execution.
        
        $executedTradeId = 'INT-' . uniqid();

        // Step 4: Log the copied trade
        CopyTradeLog::create([
            'trade_signal_id' => $signal->id,
            'subscriber_account_id' => $link->subscriber_account_id,
            'executed_volume' => $adjustedVolume,
            'executed_price' => $signal->open_price,
            'executed_trade_id' => $executedTradeId,
            'status' => 'OPEN',
            'copied_at' => now(),
        ]);

        // Update statistics
        $link->increment('total_trades_copied');
        $link->increment('successful_copies');
        $link->update(['last_trade_copied_at' => now()]);
    }

    /**
     * Close a trade signal and calculate P&L for all copied trades.
     */
    public function closeTradeSignal(TradeSignal $signal, float $closePrice): void
    {
        // Update the signal itself
        $signal->update([
            'close_price' => $closePrice,
            'closed_timestamp' => now(),
            'status' => 'CLOSED',
            'profit_loss' => $this->calculateProfitLoss(
                $signal->trade_type,
                (float) $signal->open_price,
                $closePrice,
                (float) $signal->volume
            ),
        ]);

        // Update master account balance and stats
        $master = \App\Models\MasterAccount::find($signal->master_account_id);
        if ($master) {
            $master->increment('account_balance', $signal->profit_loss);
            $master->increment('total_profit', $signal->profit_loss);
            $master->increment('total_trades');
            if ($signal->profit_loss > 0) {
                $master->increment('win_count');
            } elseif ($signal->profit_loss < 0) {
                $master->increment('loss_count');
            }
            
            // Recalculate win rate
            $master->win_rate = $master->total_trades > 0 ? ($master->win_count / $master->total_trades) * 100 : 0;
            $master->save();
        }

        // Close all linked copy trade logs
        $openCopies = CopyTradeLog::where('trade_signal_id', $signal->id)
            ->where('status', 'OPEN')
            ->get();

        foreach ($openCopies as $copy) {
            $copyPnl = $this->calculateProfitLoss(
                $signal->trade_type,
                (float) $copy->executed_price,
                $closePrice,
                (float) $copy->executed_volume
            );

            $copy->update([
                'closed_price' => $closePrice,
                'profit_loss' => $copyPnl,
                'status' => 'CLOSED',
                'closed_at' => now(),
            ]);

            // Update subscriber balance and stats
            $subscriber = Mt4Details::find($copy->subscriber_account_id);
            if ($subscriber) {
                $newBalance = ($subscriber->balance ?? 0) + $copyPnl;
                $subscriber->update([
                    'balance' => $newBalance,
                    'total_profit' => ($subscriber->total_profit ?? 0) + $copyPnl,
                    'total_trades' => ($subscriber->total_trades ?? 0) + 1,
                    'win_count' => $copyPnl > 0 ? ($subscriber->win_count ?? 0) + 1 : ($subscriber->win_count ?? 0),
                    'loss_count' => $copyPnl < 0 ? ($subscriber->loss_count ?? 0) + 1 : ($subscriber->loss_count ?? 0),
                ]);
                
                // Recalculate win rate
                $subscriber->win_rate = $subscriber->total_trades > 0 ? ($subscriber->win_count / $subscriber->total_trades) * 100 : 0;
                $subscriber->save();
            }

            // Update relationship P&L
            $relationship = CopyTradeRelationship::where('subscriber_account_id', $copy->subscriber_account_id)
                ->where('master_account_id', $signal->master_account_id)
                ->first();
            if ($relationship) {
                $relationship->increment('total_profit_loss', $copyPnl);
            }
        }

        Log::info("CopyTradingEngine: Closed signal #{$signal->id}, P&L: {$signal->profit_loss}");
    }

    /**
     * Calculate profit/loss for a forex trade.
     * Standard lot = 100,000 units.
     */
    public function calculateProfitLoss(string $type, float $openPrice, float $closePrice, float $volume): float
    {
        $pipValue = 100000; // Standard lot

        if (strtoupper($type) === 'BUY') {
            $pnl = ($closePrice - $openPrice) * $volume * $pipValue;
        } else {
            $pnl = ($openPrice - $closePrice) * $volume * $pipValue;
        }

        return round($pnl, 2);
    }

    /**
     * Calculate position size based on subscriber's account & risk settings.
     */
    public function calculatePositionSize(float $masterVolume, array $riskSettings, float $subscriberBalance): float
    {
        $strategy = $riskSettings['sizing_strategy'] ?? 'exact';

        switch ($strategy) {
            case 'exact':
                return $masterVolume;

            case 'balance_ratio':
                $masterBalance = $riskSettings['master_balance'] ?? 10000;
                if ($masterBalance <= 0) return $masterVolume;
                $ratio = $subscriberBalance / $masterBalance;
                return round($masterVolume * $ratio, 2);

            case 'multiplier':
                $multiplier = $riskSettings['volume_multiplier'] ?? 1.0;
                return round($masterVolume * $multiplier, 2);

            default:
                return $masterVolume;
        }
    }

    /**
     * Verify trade complies with subscriber's risk limits.
     */
    public function isWithinRiskLimits(Mt4Details $subscriber, float $volume, TradeSignal $signal): bool
    {
        $riskSettings = $subscriber->copyTradeRelationship->risk_settings ?? [];

        // Max position size check
        $maxPosition = $riskSettings['max_position_size'] ?? 10.0;
        if ($volume > $maxPosition) {
            return false;
        }

        // Symbol filtering
        $allowedSymbols = $riskSettings['allowed_symbols'] ?? [];
        if (!empty($allowedSymbols) && !in_array($signal->symbol, $allowedSymbols)) {
            return false;
        }

        $forbiddenSymbols = $riskSettings['forbidden_symbols'] ?? [];
        if (!empty($forbiddenSymbols) && in_array($signal->symbol, $forbiddenSymbols)) {
            return false;
        }

        return true;
    }
}

