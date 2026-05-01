<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trade;
use App\Models\User;
use Illuminate\Http\Request;

class ManageFutureController extends Controller
{
    public function index()
    {
        $trades = Trade::where('market_type', 'Future')->with('user')->orderByDesc('id')->paginate(20);
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
        $user->future_bal += ($margin + $pnl);
        
        $trade->update([
            'status' => 'Completed',
            'pnl' => $pnl,
        ]);

        $user->save();

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
