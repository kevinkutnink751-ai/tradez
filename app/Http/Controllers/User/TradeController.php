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
            'amount' => 'required|numeric|min:1',
            'leverage' => 'required|numeric|min:1',
            'price' => 'nullable|numeric',
        ]);

        $user = User::find(Auth::id());
        $pair = $this->resolvePair($request->pair, 'Future');

        if (!$pair) {
            return response()->json(['status' => 400, 'message' => 'Invalid futures instrument.']);
        }

        if ($request->leverage > $pair->leverage) {
            return response()->json(['status' => 400, 'message' => 'Leverage exceeds market limit.']);
        }

        if ($request->amount < $pair->min_amount || $request->amount > $pair->max_amount) {
            return response()->json(['status' => 400, 'message' => 'Trade size is outside the allowed range.']);
        }

        $marginRequired = $request->amount / $request->leverage;
        $settlementWallet = $this->getWalletForSymbol($user->id, $pair->quote_asset);

        if (!$settlementWallet) {
            return response()->json(['status' => 400, 'message' => "{$pair->quote_asset} futures wallet not found."]);
        }

        if ($settlementWallet->future_bal < $marginRequired) {
            return response()->json(['status' => 400, 'message' => "Insufficient {$pair->quote_asset} futures balance."]);
        }

        Trade::create([
            'user_id' => $user->id,
            'trading_pair_id' => $pair->id,
            'pair' => $pair->display_name,
            'asset_symbol' => $pair->symbol,
            'quote_asset_symbol' => $pair->quote_asset,
            'type' => $request->type,
            'market_type' => 'Future',
            'instrument_category' => $pair->instrument_category,
            'amount' => $request->amount,
            'price' => $pair->last_price,
            'leverage' => $request->leverage,
            'status' => 'Open',
            'pnl' => 0,
        ]);

        $settlementWallet->future_bal -= $marginRequired;
        $settlementWallet->save();

        return response()->json(['status' => 200, 'message' => 'Position opened successfully.']);
    }

    public function storeSpotTrade(Request $request)
    {
        $request->validate([
            'pair' => 'required|exists:trading_pairs,name',
            'type' => 'required|in:Buy,Sell',
            'amount' => 'required|numeric|min:1',
            'price' => 'nullable|numeric',
        ]);

        $user = User::find(Auth::id());
        $pair = $this->resolvePair($request->pair, 'Spot');

        if (!$pair) {
            return response()->json(['status' => 400, 'message' => 'Invalid trading pair.']);
        }

        if ($request->amount < $pair->min_amount || $request->amount > $pair->max_amount) {
            return response()->json(['status' => 400, 'message' => 'Trade size is outside the allowed range.']);
        }

        $price = $pair->last_price;
        $quoteWallet = $this->getWalletForSymbol($user->id, $pair->quote_asset);
        $assetWallet = $this->getOrCreateWalletForSymbol($user->id, $pair->symbol);

        if ($request->type == 'Buy') {
            $cost = $request->amount * $price;
            if (!$quoteWallet || $quoteWallet->spot_bal < $cost) {
                return response()->json(['status' => 400, 'message' => "Insufficient {$pair->quote_asset} spot balance."]);
            }

            $quoteWallet->spot_bal -= $cost;
            $quoteWallet->save();
            $assetWallet->spot_bal += $request->amount;
            $assetWallet->save();
        } else {
            if (!$assetWallet || $assetWallet->spot_bal < $request->amount) {
                return response()->json(['status' => 400, 'message' => "Insufficient {$pair->symbol} spot balance."]);
            }

            if (!$quoteWallet) {
                return response()->json(['status' => 400, 'message' => "{$pair->quote_asset} wallet not found."]);
            }

            $assetWallet->spot_bal -= $request->amount;
            $assetWallet->save();
            $quoteWallet->spot_bal += ($request->amount * $price);
            $quoteWallet->save();
        }

        Trade::create([
            'user_id' => $user->id,
            'trading_pair_id' => $pair->id,
            'pair' => $pair->display_name,
            'asset_symbol' => $pair->symbol,
            'quote_asset_symbol' => $pair->quote_asset,
            'type' => $request->type,
            'market_type' => 'Spot',
            'instrument_category' => $pair->instrument_category,
            'amount' => $request->amount,
            'price' => $price,
            'leverage' => 1,
            'status' => 'Completed',
            'pnl' => 0,
        ]);

        return response()->json(['status' => 200, 'message' => 'Order placed successfully.']);
    }

    public function closeTrade($id)
    {
        $trade = Trade::where('id', $id)->where('user_id', Auth::id())->where('status', 'Open')->firstOrFail();
        $user = User::find(Auth::id());

        $mockPnlPercent = rand(-10, 20) / 100;
        $pnl = $trade->amount * $mockPnlPercent;
        $settlementSymbol = $trade->quote_asset_symbol ?: 'USD';
        $settlementWallet = $this->getWalletForSymbol($user->id, $settlementSymbol);
        
        if ($trade->market_type == 'Future') {
            $margin = $trade->amount / $trade->leverage;
            if ($settlementWallet) {
                $settlementWallet->future_bal += ($margin + $pnl);
                $settlementWallet->save();
            } else {
                $user->future_bal += ($margin + $pnl);
            }
        } else {
            if ($settlementWallet) {
                $settlementWallet->spot_bal += (($trade->amount * $trade->price) + $pnl);
                $settlementWallet->save();
            } else {
                $user->spot_bal += ($trade->amount + $pnl);
            }
        }

        $trade->update([
            'status' => 'Completed',
            'pnl' => $pnl,
        ]);

        $user->save();

        return response()->json([
            'status' => 200, 
            'message' => 'Position closed with ' . ($pnl >= 0 ? 'profit' : 'loss') . ' of ' . abs($pnl) . ' ' . $settlementSymbol
        ]);
    }

    public function storeBinaryTrade(Request $request)
    {
        $request->validate([
            'pair' => 'required|exists:trading_pairs,name',
            'type' => 'required|in:Rise,Fall,Call,Put',
            'amount' => 'required|numeric|min:1',
            'duration' => 'required|numeric',
        ]);

        $user = User::find(Auth::id());
        $pair = $this->resolvePair($request->pair, 'Binary');

        if (!$pair) {
            return response()->json(['status' => 400, 'message' => 'Invalid trading pair.']);
        }

        if ($user->account_bal < $request->amount) {
            return response()->json(['status' => 400, 'message' => 'Insufficient account balance.']);
        }

        $user->account_bal -= $request->amount;
        $user->save();

        BinaryTrade::create([
            'user_id' => $user->id,
            'coin_pair' => $pair->display_name,
            'direction' => $request->type,
            'amount' => $request->amount,
            'duration' => $request->duration,
            'status' => 'Pending',
            'strike_price' => $pair->last_price,
        ]);

        return response()->json(['status' => 200, 'message' => 'Binary trade placed successfully.']);
    }

    public function storeOptionsTrade(Request $request)
    {
        $request->validate([
            'pair' => 'required|exists:trading_pairs,name',
            'type' => 'required|in:Call,Put',
            'amount' => 'required|numeric|min:1',
            'expiry' => 'required|string',
        ]);

        $user = User::find(Auth::id());
        $pair = $this->resolvePair($request->pair, 'Option');

        if (!$pair) {
            return response()->json(['status' => 400, 'message' => 'Invalid trading pair.']);
        }

        if ($user->account_bal < $request->amount) {
            return response()->json(['status' => 400, 'message' => 'Insufficient account balance.']);
        }

        $user->account_bal -= $request->amount;
        $user->save();

        OptionTrade::create([
            'user_id' => $user->id,
            'pair' => $pair->display_name,
            'type' => $request->type,
            'amount' => $request->amount,
            'strike_price' => $pair->last_price,
            'expiration' => $request->expiry,
            'status' => 'Pending',
            'pnl' => 0,
        ]);

        return response()->json(['status' => 200, 'message' => 'Options trade placed successfully.']);
    }

    protected function resolvePair(string $name, string $type): ?TradingPair
    {
        return TradingPair::with(['asset', 'quoteAssetModel'])
            ->where('name', $name)
            ->where('type', $type)
            ->where('status', true)
            ->first();
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
