<?php

namespace App\Console\Commands;

use App\Events\TradeSignalDetected;
use App\Models\CopyTradeRelationship;
use App\Models\MasterAccount;
use App\Models\Mt4Details;
use App\Models\TradeSignal;
use App\Services\CopyTradingEngine;
use Illuminate\Console\Command;

class GenerateVirtualTrades extends Command
{
    protected $signature = 'generate:virtual-trades {--action=cycle : open, close, or cycle}';

    protected $description = 'Generate virtual copy trades based on admin settings.';

    /**
     * Realistic base prices for common forex pairs.
     */
    private array $symbols = [
        'EURUSD' => 1.08500,
        'GBPUSD' => 1.27200,
        'USDJPY' => 154.500,
        'AUDUSD' => 0.65300,
        'USDCAD' => 1.37800,
        'NZDUSD' => 0.59800,
        'USDCHF' => 0.88200,
        'EURGBP' => 0.85300,
        'XAUUSD' => 2340.00,
    ];

    private const DEFAULT_BALANCE = 10000.00;

    public function handle(CopyTradingEngine $engine): void
    {
        // Check interval
        $settings = \App\Models\Settings::first();
        $interval = $settings->copy_trade_interval ?? 5;
        
        // Ensure it runs only on the exact interval boundary (minute)
        // Since we are scheduling it to run every minute, this prevents it from running when not on interval.
        if (now()->minute % $interval !== 0) {
            $this->info("Skipping execution: Current minute is not a multiple of {$interval}.");
            return;
        }

        $action = $this->option('action');

        // Ensure all accounts have default balances
        $this->ensureDefaultBalances();

        switch ($action) {
            case 'open':
                $this->openTrades($engine);
                break;
            case 'close':
                $this->closeTrades($engine);
                break;
            case 'cycle':
                $this->closeTrades($engine);
                $this->openTrades($engine);
                break;
            default:
                $this->error("Unknown action: {$action}. Use open, close, or cycle.");
        }
    }

    /**
     * Ensure all master and subscriber accounts have a default virtual balance.
     */
    private function ensureDefaultBalances(): void
    {
        MasterAccount::where('account_balance', 0)
            ->orWhereNull('account_balance')
            ->update(['account_balance' => self::DEFAULT_BALANCE]);

        Mt4Details::where('balance', 0)
            ->orWhereNull('balance')
            ->update(['balance' => self::DEFAULT_BALANCE]);
    }

    /**
     * Open new random trades on active master accounts.
     */
    private function openTrades(CopyTradingEngine $engine): void
    {
        // Get master accounts that have at least one active subscriber
        $masterIds = CopyTradeRelationship::where('status', 'ACTIVE')
            ->distinct()
            ->pluck('master_account_id');

        if ($masterIds->isEmpty()) {
            $this->warn('No active copy trade relationships found. Link a subscriber to a master first.');
            return;
        }

        foreach ($masterIds as $masterId) {
            $master = MasterAccount::find($masterId);
            if (!$master || !$master->is_active) {
                continue;
            }

            // Pick random symbol and direction
            $symbolName = array_rand($this->symbols);
            $basePrice = $this->symbols[$symbolName];
            $type = rand(0, 1) ? 'BUY' : 'SELL';
            $volume = round(rand(1, 10) * 0.01, 2); // 0.01 to 0.10 lots

            // Add small random spread to base price
            $spread = $basePrice * (rand(-10, 10) / 100000);
            $openPrice = round($basePrice + $spread, 5);

            // Random SL/TP
            $pipSize = ($symbolName === 'USDJPY' || $symbolName === 'XAUUSD') ? 0.01 : 0.0001;
            $slDistance = rand(20, 50) * $pipSize;
            $tpDistance = rand(30, 80) * $pipSize;

            if ($type === 'BUY') {
                $sl = round($openPrice - $slDistance, 5);
                $tp = round($openPrice + $tpDistance, 5);
            } else {
                $sl = round($openPrice + $slDistance, 5);
                $tp = round($openPrice - $tpDistance, 5);
            }

            // Create the trade signal
            $signal = TradeSignal::create([
                'master_account_id' => $master->id,
                'external_trade_id' => 'SBX-' . uniqid(),
                'trade_type' => $type,
                'symbol' => $symbolName,
                'volume' => $volume,
                'open_price' => $openPrice,
                'stop_loss' => $sl,
                'take_profit' => $tp,
                'signal_timestamp' => now(),
                'status' => 'NEW',
            ]);

            $this->info("✅ Opened {$type} {$volume} {$symbolName} @ {$openPrice} on master [{$master->account_name}] (Signal #{$signal->id})");

            // Fire the event → listener → engine replicates to all subscribers
            event(new TradeSignalDetected($signal));

            // Mark signal as replicated
            $signal->update(['status' => 'REPLICATED']);
        }
    }

    /**
     * Close the oldest open trades and calculate P&L.
     * Biased towards winning trades (75% win rate).
     */
    private function closeTrades(CopyTradingEngine $engine): void
    {
        // Find open signals
        $openSignals = TradeSignal::whereIn('status', ['NEW', 'REPLICATED'])
            ->whereNull('close_price')
            ->orderBy('created_at', 'asc')
            ->limit(5) // Close up to 5 at a time
            ->get();

        if ($openSignals->isEmpty()) {
            $this->info('No open trades to close.');
            return;
        }

        foreach ($openSignals as $signal) {
            $symbolName = $signal->symbol;
            $basePrice = $this->symbols[$symbolName] ?? (float) $signal->open_price;
            
            // Winning Bias: 75% chance to win
            $isWinner = rand(1, 100) <= 75;
            
            // Movement in pips (20 to 60 pips)
            $pipSize = ($symbolName === 'USDJPY' || $symbolName === 'XAUUSD') ? 0.01 : 0.0001;
            $pips = rand(20, 60);
            $movement = $pips * $pipSize;

            if ($signal->trade_type === 'BUY') {
                $closePrice = $isWinner ? (float) $signal->open_price + $movement : (float) $signal->open_price - $movement;
            } else {
                $closePrice = $isWinner ? (float) $signal->open_price - $movement : (float) $signal->open_price + $movement;
            }

            $closePrice = round($closePrice, 5);

            $engine->closeTradeSignal($signal, $closePrice);

            // Refresh to get updated P&L
            $signal->refresh();

            $emoji = $signal->profit_loss >= 0 ? '📈' : '📉';
            $status = $signal->profit_loss >= 0 ? 'WIN' : 'LOSS';
            $this->info("{$emoji} [{$status}] Closed {$signal->trade_type} {$signal->volume} {$signal->symbol} @ {$closePrice} | P&L: \${$signal->profit_loss} (Signal #{$signal->id})");
        }
    }
}
