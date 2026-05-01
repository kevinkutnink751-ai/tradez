<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trade;
use App\Models\User;
use App\Models\UserWallet;
use Illuminate\Http\Request;

class ManageFutureController extends Controller
{
    public function index()
    {
        $trades = Trade::where('market_type', 'Future')->with(['user', 'tradingPair'])->orderByDesc('id')->paginate(20);
        return view('admin.trading.futures', [
            'title' => 'Manage Future Trades',
            'trades' => $trades,
        ]);
    }

    public function closeTrade(Request $request)
    {
        $trade = Trade::where('id', $request->id)->where('status', 'Open')->firstOrFail();
        $user = User::find($trade->user_id);

        $pnl = $request->pnl ?? 0;
        
        $margin = $trade->amount / $trade->leverage;
        $settlementSymbol = $trade->quote_asset_symbol ?: 'USD';
        $settlementWallet = UserWallet::where('user_id', $user->id)
            ->whereHas('asset', function ($query) use ($settlementSymbol) {
                $query->where('symbol', $settlementSymbol);
            })
            ->first();

        if ($settlementWallet) {
            $settlementWallet->future_bal += ($margin + $pnl);
            $settlementWallet->save();
        } else {
            $user->future_bal += ($margin + $pnl);
            $user->save();
        }
        
        $trade->update([
            'status' => 'Completed',
            'pnl' => $pnl,
        ]);

        return redirect()->back()->with('success', 'Trade closed successfully for user ' . $user->name);
    }

    public function editPnl(Request $request)
    {
        $trade = Trade::where('id', $request->id)->firstOrFail();
        $trade->update(['pnl' => $request->pnl]);
        
        return redirect()->back()->with('success', 'PnL updated successfully.');
    }
    
    public function destroy($id)
    {
        Trade::destroy($id);
        return redirect()->back()->with('success', 'Trade record deleted.');
    }
}
