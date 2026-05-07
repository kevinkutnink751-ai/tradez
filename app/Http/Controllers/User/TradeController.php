<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Trade;
use App\Models\Asset;
use App\Models\BinaryTrade;
use App\Models\OptionTrade;
use App\Models\TradingPair;
use App\Models\User;
use App\Models\UserWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TradeController extends Controller
{
    public function storeFutureTrade(Request $request)
    {
        $request->validate([
            'pair' => 'required|exists:trading_pairs,name',
            'type' => 'required|in:Buy,Sell',
            'order_type' => 'required|in:Market,Limit,Stop',
            'amount' => 'required|numeric|min:0.0001',
            'leverage' => 'required|numeric|min:1',
            'price' => 'nullable|numeric',
            'settlement_asset' => 'nullable|string',
            'mode' => 'nullable|in:Live,Demo',
        ]);

        $isDemo = ($request->mode === 'Demo');
        $user = User::find(Auth::id());
        $pair = $this->resolvePair($request->pair, 'Future');

        if (!$pair) {
            return response()->json(['status' => 400, 'message' => 'Invalid futures instrument.']);
        }

        $settlementSymbol = $request->settlement_asset ?: $pair->quote_asset;
        $settlementAsset = Asset::where('symbol', $settlementSymbol)->first();
        
        if (!$settlementAsset || !in_array($settlementAsset->type, ['Crypto', 'Fiat'])) {
            $settlementSymbol = 'USD';
            $settlementAsset = Asset::where('symbol', 'USD')->first();
        }

        $orderType = $request->order_type;
        $price = ($orderType === 'Market') ? $pair->last_price : ($request->price ?: $pair->last_price);

        // Interpretation logic
        if ($settlementSymbol === $pair->symbol) {
            $baseAmount = $request->amount;
            $notionalUsd = $baseAmount * $price;
        } else {
            // Assume settlement asset is either quote or another margin asset
            // If it's USD, amount is USD. If it's another asset, amount is in that asset's units.
            $notionalUsd = $request->amount * ($settlementAsset->base_rate ?: 1);
            $baseAmount = $notionalUsd / $price;
        }

        $marginRequiredUsd = $notionalUsd / $request->leverage;
        
        if ($request->leverage > $pair->leverage) {
            return response()->json(['status' => 400, 'message' => 'Leverage exceeds market limit.']);
        }

        if ($baseAmount < $pair->min_amount || $baseAmount > $pair->max_amount) {
            return response()->json(['status' => 400, 'message' => 'Trade size is outside the allowed range.']);
        }

        if ($isDemo) {
            // Demo mode: deduct from user's demo_bal
            if ($user->demo_bal < $marginRequiredUsd) {
                return response()->json(['status' => 400, 'message' => 'Insufficient demo balance.']);
            }
            $user->demo_bal -= $marginRequiredUsd;
            $user->save();
        } else {
            // Live mode: deduct from wallet
            $marginRequired = $marginRequiredUsd / ($settlementAsset->base_rate ?: 1);
            $settlementWallet = $this->getOrCreateWalletForSymbol($user->id, $settlementSymbol);

            if (!$settlementWallet || $settlementWallet->future_bal < $marginRequired) {
                return response()->json(['status' => 400, 'message' => "Insufficient {$settlementSymbol} futures balance."]);
            }

            $settlementWallet->future_bal -= $marginRequired;
            $settlementWallet->save();
        }

        Trade::create([
            'user_id' => $user->id,
            'trading_pair_id' => $pair->id,
            'pair' => $pair->display_name,
            'asset_symbol' => $pair->symbol,
            'quote_asset_symbol' => $pair->quote_asset,
            'settlement_asset' => $settlementSymbol,
            'type' => $request->type,
            'market_type' => 'Future',
            'order_type' => $orderType,
            'instrument_category' => $pair->instrument_category,
            'amount' => $baseAmount,
            'price' => $price,
            'leverage' => $request->leverage,
            'status' => ($orderType === 'Market') ? 'Open' : 'Pending',
            'pnl' => 0,
            'is_demo' => $isDemo,
        ]);

        return response()->json(['status' => 200, 'message' => ($isDemo ? '[DEMO] ' : '') . 'Position opened successfully.']);
    }

    public function storeSpotTrade(Request $request)
    {
        $request->validate([
            'pair' => 'required|exists:trading_pairs,name',
            'type' => 'required|in:Buy,Sell',
            'amount' => 'required|numeric|min:0.000001',
            'price' => 'nullable|numeric',
            'settlement_asset' => 'nullable|string',
            'mode' => 'nullable|in:Live,Demo',
        ]);

        $isDemo = ($request->mode === 'Demo');
        $user = User::find(Auth::id());
        $pair = $this->resolvePair($request->pair, 'Spot');

        if (!$pair) {
            return response()->json(['status' => 400, 'message' => 'Invalid trading pair.']);
        }

        $settlementSymbol = $request->settlement_asset ?: $pair->quote_asset;
        $settlementAsset = Asset::where('symbol', $settlementSymbol)->first();
        
        if (!$settlementAsset || !in_array($settlementAsset->type, ['Crypto', 'Fiat'])) {
            $settlementSymbol = 'USD';
            $settlementAsset = Asset::where('symbol', 'USD')->first();
        }

        $price = $pair->last_price;

        if ($settlementSymbol === $pair->symbol) {
            $baseAmount = $request->amount;
            $quoteAmount = $baseAmount * $price;
        } else {
            // If paying with quote or another asset
            $usdValue = $request->amount * ($settlementAsset->base_rate ?: 1);
            $baseAmount = $usdValue / $price;
            $quoteAmount = $usdValue;
        }

        if ($isDemo) {
            // Demo mode: deduct/credit from user's demo_bal
            $cost = $request->amount * ($settlementAsset->base_rate ?: 1);
            if ($user->demo_bal < $cost) {
                return response()->json(['status' => 400, 'message' => 'Insufficient demo balance.']);
            }
            $user->demo_bal -= $cost;
            $user->save();
        } else {
            // Live mode: real wallet operations
            $settlementWallet = $this->getOrCreateWalletForSymbol($user->id, $settlementSymbol);
            $cost = $request->amount; // The actual amount of settlement asset spent

            if ($request->type === 'Buy') {
                if ($settlementWallet->spot_bal < $cost) {
                    return response()->json(['status' => 400, 'message' => "Insufficient {$settlementSymbol} balance."]);
                }
                $settlementWallet->spot_bal -= $cost;
                $baseWallet = $this->getOrCreateWalletForSymbol($user->id, $pair->symbol);
                $baseWallet->spot_bal += $baseAmount;
                
                $settlementWallet->save();
                $baseWallet->save();
            } else {
                // Selling: user must have enough base asset
                $baseWallet = $this->getOrCreateWalletForSymbol($user->id, $pair->symbol);
                if ($baseWallet->spot_bal < $baseAmount) {
                    return response()->json(['status' => 400, 'message' => "Insufficient {$pair->symbol} balance."]);
                }
                $baseWallet->spot_bal -= $baseAmount;
                $settlementWallet->spot_bal += $cost;
                
                $baseWallet->save();
                $settlementWallet->save();
            }
        }

        Trade::create([
            'user_id' => $user->id,
            'trading_pair_id' => $pair->id,
            'pair' => $pair->display_name,
            'asset_symbol' => $pair->symbol,
            'quote_asset_symbol' => $pair->quote_asset,
            'settlement_asset' => $settlementSymbol,
            'type' => $request->type,
            'market_type' => 'Spot',
            'instrument_category' => $pair->instrument_category,
            'amount' => $baseAmount,
            'price' => $price,
            'leverage' => 1,
            'status' => 'Completed',
            'pnl' => 0,
            'is_demo' => $isDemo,
        ]);

        return response()->json(['status' => 200, 'message' => ($isDemo ? '[DEMO] ' : '') . 'Spot trade executed successfully.']);
    }

    public function closeTrade($id)
    {
        $trade = Trade::where('id', $id)->where('user_id', Auth::id())->where('status', 'Open')->firstOrFail();
        $user = User::find(Auth::id());

        // Simple P&L simulation for demo purposes
        // In production, this would be (Current Price - Entry Price) * Amount
        $mockPnlPercent = rand(-5, 15) / 100;
        $pnl = ($trade->amount * $trade->price) * $mockPnlPercent;
        
        $settlementSymbol = $trade->settlement_asset ?: 'USD';
        $margin = ($trade->amount * $trade->price) / $trade->leverage;
        $pnlInSettlement = $pnl / ($trade->price ?: 1); // rough conversion if settlement is base

        if ($trade->is_demo) {
            // Demo mode: credit back to demo_bal
            $user->demo_bal += ($margin + $pnlInSettlement);
            $user->save();
        } else {
            // Live mode: credit back to wallet
            $settlementWallet = $this->getWalletForSymbol($user->id, $settlementSymbol);
            if ($trade->market_type == 'Future') {
                if ($settlementWallet) {
                    $settlementWallet->future_bal += ($margin + $pnlInSettlement);
                    $settlementWallet->save();
                }
            }
        }

        $trade->update([
            'status' => 'Completed',
            'pnl' => $pnlInSettlement,
        ]);

        return response()->json([
            'status' => 200, 
            'message' => ($trade->is_demo ? '[DEMO] ' : '') . 'Position closed successfully.',
            'data' => [
                'pnl' => number_format($pnlInSettlement, 4),
                'symbol' => $settlementSymbol,
                'completion_type' => 'Auto-Settled',
                'new_balance' => $trade->is_demo 
                    ? number_format($user->demo_bal, 4)
                    : number_format($this->getWalletForSymbol($user->id, $settlementSymbol)->future_bal ?? 0, 4),
            ]
        ]);
    }

    public function cancelTrade($id)
    {
        $trade = Trade::where('id', $id)->where('user_id', Auth::id())->where('status', 'Pending')->firstOrFail();
        $user = User::find(Auth::id());

        $settlementSymbol = $trade->settlement_asset ?: 'USD';
        $margin = ($trade->amount * $trade->price) / $trade->leverage;

        if ($trade->is_demo) {
            // Demo mode: credit back to demo_bal
            $user->demo_bal += $margin;
            $user->save();
        } else {
            // Live mode: credit back to wallet
            $settlementWallet = $this->getWalletForSymbol($user->id, $settlementSymbol);
            if ($trade->market_type == 'Future') {
                if ($settlementWallet) {
                    $settlementWallet->future_bal += $margin;
                    $settlementWallet->save();
                }
            }
        }

        $trade->update(['status' => 'Canceled']);

        return response()->json([
            'status' => 200, 
            'message' => ($trade->is_demo ? '[DEMO] ' : '') . 'Order canceled and margin released.',
            'data' => [
                'completion_type' => 'Auto',
                'new_balance' => $trade->is_demo
                    ? number_format($user->demo_bal, 4)
                    : number_format($this->getWalletForSymbol($user->id, $settlementSymbol)->future_bal ?? 0, 4),
            ]
        ]);
    }

    public function storeBinaryTrade(Request $request)
    {
        $request->validate([
            'pair' => 'required|exists:trading_pairs,name',
            'type' => 'required|in:Rise,Fall,Call,Put',
            'amount' => 'required|numeric|min:1',
            'duration' => 'required|numeric',
            'mode' => 'nullable|in:Live,Demo',
        ]);

        $isDemo = ($request->mode === 'Demo');
        $user = User::find(Auth::id());
        $pair = $this->resolvePair($request->pair, 'Binary');

        if (!$pair) {
            return response()->json(['status' => 400, 'message' => 'Invalid trading pair.']);
        }

        $balanceField = $isDemo ? 'demo_bal' : 'account_bal';

        if ($user->{$balanceField} < $request->amount) {
            return response()->json(['status' => 400, 'message' => 'Insufficient ' . ($isDemo ? 'demo' : 'account') . ' balance.']);
        }

        $user->{$balanceField} -= $request->amount;
        $user->save();

        BinaryTrade::create([
            'user_id' => $user->id,
            'coin_pair' => $pair->display_name,
            'direction' => $request->type,
            'amount' => $request->amount,
            'duration' => $request->duration,
            'status' => 'Pending',
            'strike_price' => $pair->last_price,
            'is_demo' => $isDemo,
        ]);

        return response()->json(['status' => 200, 'message' => ($isDemo ? '[DEMO] ' : '') . 'Binary trade placed successfully.']);
    }

    public function storeOptionsTrade(Request $request)
    {
        $request->validate([
            'pair' => 'required|exists:trading_pairs,name',
            'type' => 'required|in:Call,Put',
            'amount' => 'required|numeric|min:1',
            'expiry' => 'required|numeric',
            'mode' => 'nullable|in:Live,Demo',
        ]);

        $isDemo = ($request->mode === 'Demo');
        $user = User::find(Auth::id());
        $pair = $this->resolvePair($request->pair, 'Option');

        if (!$pair) {
            return response()->json(['status' => 400, 'message' => 'Invalid trading pair.']);
        }

        $balanceField = $isDemo ? 'demo_bal' : 'account_bal';

        if ($user->{$balanceField} < $request->amount) {
            return response()->json(['status' => 400, 'message' => 'Insufficient ' . ($isDemo ? 'demo' : 'account') . ' balance.']);
        }

        $user->{$balanceField} -= $request->amount;
        $user->save();

        OptionTrade::create([
            'user_id' => $user->id,
            'pair' => $pair->display_name,
            'type' => $request->type,
            'amount' => $request->amount,
            'strike_price' => $pair->last_price,
            'expiration' => now()->addSeconds((int)$request->expiry),
            'status' => 'Pending',
            'pnl' => 0,
            'is_demo' => $isDemo,
        ]);

        return response()->json(['status' => 200, 'message' => ($isDemo ? '[DEMO] ' : '') . 'Options trade placed successfully.']);
    }


    protected function resolvePair(string $name, string $type): ?TradingPair
    {
        return TradingPair::with(['asset', 'quoteAssetModel'])
            ->where('name', $name)
            ->where('status', true)
            ->get()
            ->first(fn ($pair) => $pair->supportsMarket($type));
    }

    protected function getWalletForSymbol(int $userId, string $symbol): ?UserWallet
    {
        return UserWallet::where('user_id', $userId)
            ->whereHas('asset', function ($query) use ($symbol) {
                $query->where('symbol', $symbol);
            })
            ->first();
    }

    protected function getOrCreateWalletForSymbol(int $userId, string $symbol): ?UserWallet
    {
        $wallet = $this->getWalletForSymbol($userId, $symbol);

        if ($wallet) {
            return $wallet;
        }

        $asset = Asset::where('symbol', $symbol)->first();

        if (!$asset) {
            return null;
        }

        return UserWallet::create([
            'user_id' => $userId,
            'asset_id' => $asset->id,
        ]);
    }
}
