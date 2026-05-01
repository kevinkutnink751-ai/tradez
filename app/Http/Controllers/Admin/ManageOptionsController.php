<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OptionTrade;
use App\Models\User;
use Illuminate\Http\Request;

class ManageOptionsController extends Controller
{
    public function index()
    {
        return view('admin.trading.options', [
            'title' => 'Manage Options Trades',
            'trades' => OptionTrade::with('user')->orderByDesc('id')->paginate(20),
        ]);
    }

    public function update(Request $request, $id)
    {
        $trade = OptionTrade::findOrFail($id);
        $trade->update([
            'status' => $request->status,
            'pnl' => $request->pnl,
        ]);

        if ($request->status == 'Won') {
            $user = User::find($trade->user_id);
            $user->account_bal += $trade->amount + $request->pnl;
            $user->save();
        }

        return redirect()->back()->with('success', 'Trade updated successfully');
    }

    public function destroy($id)
    {
        OptionTrade::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Trade deleted successfully');
    }
}
