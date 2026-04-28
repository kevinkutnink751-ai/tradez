<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mt4Details;
use App\Models\Settings;
use App\Services\TradingService;
use App\Traits\PingServer;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    use PingServer;

    public function myTradingSettings()
    {
        $data = TradingService::settings();

        return view('admin.subscription.trading-settings', [
            'title' => 'Trading Settings',
            'accounts' => $data->accounts,
            'myaccount' => $data->my_account,
            'data' => $data->trading_accounts,
            'amountPerSlot' => $data->amount_per_slot,
        ]);
    }

    public function createCopyMasterAccount(Request $request)
    {
        $response = $this->fetctApi(
            '/create-copytrade-account',
            [
                'login' => $request->login,
                'password' => $request->password,
                'serverName' => $request->serverName,
                'name' => $request->name,
                'leverage' => $request->leverage,
                'account_type' => $request->acntype,
                'baseCurrency' => $request->currency ? $request->currency : 'USD',
            ],
            'POST',
        );

        if ($response->failed()) {
            return redirect()->back()->with('message', $response['message']);
        }
        return redirect()->back()->with('success', $response['message']);
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

        $updated = \App\Services\TradingService::updateStrategy($request->account_id, [
            'mode' => $request->trademode,
            'strategy_name' => $request->name,
            'description' => $request->desc,
            'modecompliment' => $modeCompliment,
        ]);

        if (!$updated) {
            return back()->with('message', 'Failed to update strategy');
        }

        return back()->with('success', 'Strategy updated successfully');
    }

    public function deleteMasterAccount($id)
    {
        $deleted = TradingService::deleteAccount($id);

        if (!$deleted) {
            return back()->with('message', 'Delete failed');
        }

        return back()->with('success', 'Account deleted successfully');
    }

    public function renewAccount(Request $request)
    {
        $renewed = TradingService::renewAccount($request->account_id);

        if (!$renewed) {
            return back()->with('message', 'Renewal failed');
        }

        return back()->with('success', 'Account renewed successfully');
    }

    public function delsub($id)
    {
        Mt4Details::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Subscription Sucessfully Deleted');
    }
}
