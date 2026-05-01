<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mt4Details;
use App\Models\Settings;
use App\Models\MasterAccount;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{

    public function myTradingSettings()
    {
        $masters = MasterAccount::all();
        $accounts = Mt4Details::all();
        $settings = Settings::find(1);

        return view('admin.subscription.trading-settings', [
            'title' => 'Trading Settings',
            'accounts' => $masters,
            'trading_accounts' => $accounts,
            'amountPerSlot' => $settings->monthlyfee,
        ]);
    }

    public function createCopyMasterAccount(Request $request)
    {
        MasterAccount::create([
            'name' => $request->name,
            'account_name' => $request->name,
            'bot_type' => $request->bot_type ?? 'moderate',
            'risk_level' => $request->risk_level ?? 'Moderate',
            'roi' => $request->roi ?? 0,
            'drawdown' => $request->drawdown ?? 0,
            'leverage' => $request->leverage,
            'account_type' => $request->acntype,
            'currency' => $request->currency ?? 'USD',
        ]);

        return redirect()->back()->with('success', 'Master bot account created successfully.');
    }

    public function updateStrategy(Request $request)
    {
        if ($request->has('fixedRisk')) {
            $modeCompliment = $request->fixedRisk;
        } elseif ($request->has('fixedVolume')) {
            $modeCompliment = $request->fixedVolume;
        } elseif ($request->has('expression')) {
            $modeCompliment = $request->expression;
        } else {
            $modeCompliment = '';
        }

        $master = MasterAccount::find($request->account_id);
        if (!$master) {
            return back()->with('message', 'Master account not found');
        }

        $master->update([
            'strategy_mode' => $request->trademode,
            'strategy_name' => $request->name,
            'strategy_description' => $request->desc,
            'stra_com' => $modeCompliment,
        ]);

        return back()->with('success', 'Strategy updated successfully');
    }

    public function deleteMasterAccount($id)
    {
        $master = MasterAccount::find($id);
        if ($master) {
            $master->delete();
        }

        return back()->with('success', 'Account deleted successfully');
    }

    public function renewAccount(Request $request)
    {
        $master = MasterAccount::find($request->account_id);
        if (!$master) {
            return back()->with('message', 'Master account not found');
        }

        $master->update([
            'is_active' => true,
        ]);

        return back()->with('success', 'Account renewed successfully');
    }

    public function sendSignal(Request $request, \App\Services\CopyTradingEngine $engine)
    {
        $master = MasterAccount::find($request->master_id);
        if (!$master) {
            return redirect()->back()->with('message', 'Master account not found');
        }

        $signal = \App\Models\TradeSignal::create([
            'master_account_id' => $master->id,
            'external_trade_id' => 'MAN-' . uniqid(),
            'trade_type' => $request->type,
            'symbol' => $request->symbol,
            'volume' => $request->volume,
            'open_price' => $request->price,
            'stop_loss' => $request->sl,
            'take_profit' => $request->tp,
            'signal_timestamp' => now(),
            'status' => 'NEW',
        ]);

        // Trigger replication
        event(new \App\Events\TradeSignalDetected($signal));

        // Mark signal as replicated
        $signal->update(['status' => 'REPLICATED']);

        return redirect()->back()->with('success', 'Signal sent and replication triggered successfully.');
    }

    public function closeSignal(Request $request, \App\Services\CopyTradingEngine $engine)
    {
        $signal = \App\Models\TradeSignal::find($request->signal_id);
        if (!$signal) {
            return redirect()->back()->with('message', 'Signal not found');
        }

        if ($signal->status === 'CLOSED') {
            return redirect()->back()->with('message', 'This signal is already closed');
        }

        $engine->closeTradeSignal($signal, (float) $request->close_price);

        return redirect()->back()->with('success', "Signal #{$signal->id} closed. P&L: \${$signal->fresh()->profit_loss}");
    }

    public function delsub($id)
    {
        Mt4Details::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Subscription Sucessfully Deleted');
    }
}
