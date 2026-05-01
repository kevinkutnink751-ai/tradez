<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Trade;
use App\Models\BinaryTrade;
use App\Models\OptionTrade;
use App\Models\TradingPair;
use App\Models\User;
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
            'price' => 'required|numeric',
        ]);

        $user = User::find(Auth::id());
        $pair = TradingPair::where('name', $request->pair)->where('type', 'Future')->first();

        if (!$pair) {
            return response()->json(['status' => 400, 'message' => 'Invalid trading pair.']);
        }

        if ($request->leverage > $pair->leverage) {
            return response()->json(['status' => 400, 'message' => 'Leverage exceeds market limit.']);
        }

        // Calculate margin required
        $marginRequired = $request->amount / $request->leverage;

        // Find USD wallet
        $usdWallet = \App\Models\UserWallet::where('user_id', $user->id)
            ->whereHas('asset', function($q) {
                $q->where('symbol', 'USD');
            })->first();

        if (!$usdWallet) {
            return response()->json(['status' => 400, 'message' => 'USD wallet not found. Please create one.']);
        }

        if ($usdWallet->future_bal < $marginRequired) {
            return response()->json(['status' => 400, 'message' => 'Insufficient USD future balance.']);
        }

        // Create Trade
        Trade::create([
            'user_id' => $user->id,
            'pair' => $pair->name,
            'type' => $request->type,
            'market_type' => 'Future',
            'amount' => $request->amount,
            'price' => $request->price,
            'leverage' => $request->leverage,
            'status' => 'Open',
            'pnl' => 0,
        ]);

        // Deduct margin
        $usdWallet->future_bal -= $marginRequired;
        $usdWallet->save();

        return response()->json(['status' => 200, 'message' => 'Position opened successfully.']);
    }

    public function storeSpotTrade(Request $request)
    {
        $request->validate([
            'pair' => 'required|exists:trading_pairs,name',
            'type' => 'required|in:Buy,Sell',
            'amount' => 'required|numeric|min:1',
            'price' => 'required|numeric',
        ]);

        $user = User::find(Auth::id());
        $pair = TradingPair::where('name', $request->pair)->where('type', 'Spot')->first();

        if (!$pair) {
            return response()->json(['status' => 400, 'message' => 'Invalid trading pair.']);
        }

        if ($request->type == 'Buy') {
            $cost = $request->amount * $request->price;
            if ($user->spot_bal < $cost) {
                return response()->json(['status' => 400, 'message' => 'Insufficient spot balance.']);
            }
            $user->spot_bal -= $cost;
        } else {
            if ($user->spot_bal < $request->amount) {
                 return response()->json(['status' => 400, 'message' => 'Insufficient asset balance.']);
            }
            $user->spot_bal -= $request->amount;
        }

        Trade::create([
            'user_id' => $user->id,
            'pair' => $pair->name,
            'type' => $request->type,
            'market_type' => 'Spot',
            'amount' => $request->amount,
            'price' => $request->price,
            'leverage' => 1,
            'status' => 'Open',
            'pnl' => 0,
        ]);

        $user->save();

        return response()->json(['status' => 200, 'message' => 'Order placed successfully.']);
    }

    public function closeTrade($id)
    {
        $trade = Trade::where('id', $id)->where('user_id', Auth::id())->where('status', 'Open')->firstOrFail();
        $user = User::find(Auth::id());

        $mockPnlPercent = rand(-10, 20) / 100;
        $pnl = $trade->amount * $mockPnlPercent;
        
        if ($trade->market_type == 'Future') {
            $margin = $trade->amount / $trade->leverage;
            $user->future_bal += ($margin + $pnl);
        } else {
            $user->spot_bal += ($trade->amount + $pnl);
        }

        $trade->update([
            'status' => 'Completed',
            'pnl' => $pnl,
        ]);

        $user->save();

        return response()->json([
            'status' => 200, 
            'message' => 'Position closed with ' . ($pnl >= 0 ? 'profit' : 'loss') . ' of ' . abs($pnl) . ' USDT'
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
        if ($user->account_bal < $request->amount) {
            return response()->json(['status' => 400, 'message' => 'Insufficient account balance.']);
        }

        $user->account_bal -= $request->amount;
        $user->save();

        BinaryTrade::create([
            'user_id' => $user->id,
            'coin_pair' => $request->pair,
            'direction' => $request->type,
            'amount' => $request->amount,
            'duration' => $request->duration,
            'status' => 'Pending',
            'strike_price' => $request->price ?? 64231.50,
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
        if ($user->account_bal < $request->amount) {
            return response()->json(['status' => 400, 'message' => 'Insufficient account balance.']);
        }

        $user->account_bal -= $request->amount;
        $user->save();

        OptionTrade::create([
            'user_id' => $user->id,
            'pair' => $request->pair,
            'type' => $request->type,
            'amount' => $request->amount,
            'strike_price' => $request->price ?? 64231.50,
            'expiration' => $request->expiry,
            'status' => 'Pending',
            'pnl' => 0,
        ]);

        return response()->json(['status' => 200, 'message' => 'Options trade placed successfully.']);
    }
}
