<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NewNotification;
use App\Models\Mt4Details;
use App\Models\Settings;
use App\Models\User;
use App\Models\Tp_Transaction;
use App\Models\Mt4TransactionLog;
use App\Models\CopyTradeRelationship;
use App\Models\DeploymentRecord;
use App\Services\CopyTradingEngine;
use App\Models\MasterAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class TradingAccountController extends Controller
{
    public function saveMasterAccount(Request $request)
    {
        MasterAccount::create([
            'name' => $request->name ?? $request->account_name,
            'account_name' => $request->account_name,
            'account_type' => $request->account_type,
            'currency' => $request->currency ?? 'USD',
            'leverage' => $request->leverage,
            'strategy_name' => $request->strategy_name,
            'strategy_description' => $request->strategy_description,
            'strategy_mode' => $request->strategy_mode,
            'stra_com' => $request->stra_com,
            'bot_type' => $request->bot_type ?? 'moderate',
            'risk_level' => $request->risk_level ?? 'Moderate',
            'roi' => $request->roi ?? 0,
            'drawdown' => $request->drawdown ?? 0,
        ]);

        return redirect()->back()->with('success', 'Master account saved successfully.');
    }

    public function updateMasterStrategy(Request $request, $id)
    {
        $master = MasterAccount::find($id);
        if (!$master) {
            return redirect()->back()->with('message', 'Master account not found.');
        }

        $master->update([
            'strategy_name' => $request->strategy_name,
            'strategy_description' => $request->strategy_description,
            'strategy_mode' => $request->strategy_mode,
            'stra_com' => $request->stra_com,
        ]);

        return redirect()->back()->with('success', 'Master strategy updated successfully.');
    }

    public function deleteMasterAccount($id)
    {
        $master = MasterAccount::find($id);
        if ($master) {
            $master->delete();
        }
        return redirect()->back()->with('success', 'Master account deleted successfully.');
    }

    public function tradingAccounts()
    {
        $accounts = Mt4Details::with(['tuser', 'copyTradeRelationship', 'copyTradeLogs'])
            ->orderBy('id', 'desc')
            ->get();
        $masters = MasterAccount::all();
        $settings = Settings::find(1);

        // Summary stats
        $totalAccounts = $accounts->count();
        $activeAccounts = $accounts->where('status', 'Active')->count();
        $copyTradeEnabled = $accounts->where('copy_trade_enabled', true)->count();
        $totalBalance = $accounts->sum('balance');
        $totalPnl = $accounts->sum('total_profit'); // Using cached stats
        $openTrades = \App\Models\CopyTradeLog::where('status', 'OPEN')->count();

        return view('admin.subscription.tradingAccounts', [
            'title' => 'Trading Accounts',
            'accounts' => $accounts,
            'masters' => $masters,
            'amountPerSlot' => $settings->monthlyfee,
            'stats' => [
                'total' => $totalAccounts,
                'active' => $activeAccounts,
                'copy_enabled' => $copyTradeEnabled,
                'total_balance' => $totalBalance,
                'total_pnl' => $totalPnl,
                'open_trades' => $openTrades,
            ],
        ]);
    }

    public function accountDetail($id)
    {
        $account = Mt4Details::with(['tuser', 'copyTradeRelationship', 'copyTradeLogs', 'transactionLogs', 'deploymentRecords'])
            ->findOrFail($id);

        $master = $account->master_account_id ? MasterAccount::find($account->master_account_id) : null;
        $masters = MasterAccount::all();

        // Get all copy trade logs with signal data
        $trades = \App\Models\CopyTradeLog::where('subscriber_account_id', $id)
            ->with('signal')
            ->orderBy('created_at', 'desc')
            ->get();

        $openTrades = $trades->where('status', 'OPEN');
        $closedTrades = $trades->where('status', 'CLOSED');

        return view('admin.subscription.accountDetail', [
            'title' => 'Account Detail — ' . ($account->account_name ?? $account->mt4_id),
            'account' => $account,
            'master' => $master,
            'masters' => $masters,
            'trades' => $trades,
            'openTrades' => $openTrades,
            'closedTrades' => $closedTrades,
            'stats' => [
                'total_pnl' => $account->total_profit, // Cached
                'win_count' => $account->win_count,   // Cached
                'loss_count' => $account->loss_count, // Cached
                'win_rate' => $account->win_rate,     // Cached
                'total_trades' => $account->total_trades, // Cached
                'open_count' => $openTrades->count(),
            ],
        ]);
    }

    public function masterAudit($id)
    {
        $master = MasterAccount::findOrFail($id);

        // All subscribers copying this master
        $relationships = CopyTradeRelationship::where('master_account_id', $id)
            ->with('subscriber')
            ->get();

        // All signals from this master
        $signals = \App\Models\TradeSignal::where('master_account_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        $openSignals = $signals->whereIn('status', ['NEW', 'REPLICATED']);
        $closedSignals = $signals->where('status', 'CLOSED');

        // Subscriber P&L breakdown
        $subscriberStats = $relationships->map(function ($rel) {
            $sub = $rel->subscriber;
            return [
                'id' => $sub->id ?? null,
                'name' => $sub->account_name ?? 'N/A',
                'mt4_id' => $sub->mt4_id ?? 'N/A',
                'balance' => $sub->balance ?? 0,
                'total_copied' => $sub->total_trades ?? 0,
                'successful' => $sub->win_count ?? 0,
                'failed' => $sub->loss_count ?? 0,
                'pnl' => $sub->total_profit ?? 0,
                'status' => $rel->status,
                'enabled_at' => $rel->enabled_at,
            ];
        });

        return view('admin.subscription.masterAudit', [
            'title' => 'Master Audit — ' . ($master->account_name ?? $master->mt4_id),
            'master' => $master,
            'relationships' => $relationships,
            'subscriberStats' => $subscriberStats,
            'signals' => $signals,
            'openSignals' => $openSignals,
            'closedSignals' => $closedSignals,
            'stats' => [
                'total_pnl' => $master->total_profit, // Cached
                'win_count' => $master->win_count,   // Cached
                'loss_count' => $master->loss_count, // Cached
                'win_rate' => $master->win_rate,     // Cached
                'total_signals' => $master->total_trades, // Cached
                'open_count' => $openSignals->count(),
                'subscriber_count' => $relationships->count(),
            ],
        ]);
    }

    public function toggleCopyTrade($id)
    {
        $account = Mt4Details::findOrFail($id);
        $account->copy_trade_enabled = !$account->copy_trade_enabled;
        $account->save();

        // If disabling, also pause the relationship
        if (!$account->copy_trade_enabled) {
            CopyTradeRelationship::where('subscriber_account_id', $id)
                ->update(['status' => 'PAUSED', 'disabled_at' => now()]);
        } else {
            CopyTradeRelationship::where('subscriber_account_id', $id)
                ->update(['status' => 'ACTIVE', 'disabled_at' => null]);
        }

        $status = $account->copy_trade_enabled ? 'enabled' : 'disabled';
        return redirect()->back()->with('success', "Copy trading {$status} for account #{$account->mt4_id}.");
    }


    public function renewAccount(Request $request)
    {
        $account = Mt4Details::find($request->account_id);
        if (!$account) {
            return redirect()->back()->with('message', 'Account not found.');
        }

        $account->update([
            'end_date' => now()->addMonth(),
            'deployment_status' => 'DEPLOYED',
        ]);

        return redirect()->back()->with('success', 'Account renewed successfully.');
    }

    public function createSubscriberAccount(Request $request)
    {
        // $response = $this->fetctApi('/create-sub-account', [
        //     'login' => $request->login,
        //     'password' => $request->password,
        //     'serverName' => $request->serverName,
        //     'name' => $request->name,
        //     'leverage' => $request->leverage,
        //     'account_type' => $request->acntype,
        //     'baseCurrency' => $request->currency ? $request->currency : 'USD',
        // ], 'POST');

        // if ($response->failed()) {
        //     return redirect()->back()->with('message', $response['message']);
        // }

        if ($request->has('mt4id')) {
            $this->confirmsub($request->mt4id);
        }
        return redirect()->back()->with('success', 'Subscriber account has been created successfully!');
    }


    public function deleteSubAccount($id)
    {
        $account = Mt4Details::find($id);
        if ($account) {
            $account->delete();
        }
        return redirect()->back()->with('success', 'Account deleted successfully.');
    }

    public function copyTrade(Request $request, CopyTradingEngine $engine)
    {
        $subscriber = Mt4Details::find($request->subscriberid);
        if (!$subscriber) {
            return redirect()->back()->with('message', 'Subscriber account not found.');
        }

        try {
            // STEP 1: Create or update CopyTradeRelationship
            $relationship = CopyTradeRelationship::updateOrCreate(
                ['subscriber_account_id' => $subscriber->id],
                [
                    'master_account_id' => $request->master,
                    'status' => 'ACTIVE',
                    'risk_settings' => [
                        'sizing_strategy' => $request->sizing_strategy ?? 'exact',
                        'volume_multiplier' => $request->multiplier ?? 1.0,
                    ],
                    'enabled_at' => now(),
                ]
            );

            // STEP 2: Update Mt4Details
            $subscriber->update([
                'master_account_id' => $request->master,
                'copy_trade_enabled' => true,
            ]);

            // STEP 3: Audit Log
            Mt4TransactionLog::create([
                'subscriber_account_id' => $subscriber->id,
                'admin_id' => Auth::guard('admin')->user()->id ?? null,
                'action' => 'COPY_TRADE_ENABLED',
                'details' => ['master_id' => $request->master]
            ]);

            return redirect()->back()->with('success', 'Copy trading enabled successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Failed to enable copy trading: ' . $e->getMessage());
        }
    }


    public function deployment($id, $deployment)
    {
        $subscriber = Mt4Details::find($id);
        if (!$subscriber) {
            return redirect()->back()->with('message', 'Subscriber account not found.');
        }

        try {
            // STEP 1: Validate if copy trade is enabled
            if ($deployment == 'Deploy' && !$subscriber->copy_trade_enabled) {
                return redirect()->back()->with('message', 'Please enable copy trading before deploying.');
            }

            // STEP 2: Log the deployment attempt
            $record = DeploymentRecord::create([
                'subscriber_account_id' => $subscriber->id,
                'type' => strtoupper($deployment),
                'status' => 'SUCCESS',
                'admin_id' => Auth::guard('admin')->user()->id ?? null,
            ]);

            // STEP 3: Update Mt4Details status
            $subscriber->update([
                'deployment_status' => $deployment == 'Deploy' ? 'DEPLOYED' : 'UNDEPLOYED',
            ]);

            // STEP 4: Audit Log
            Mt4TransactionLog::create([
                'subscriber_account_id' => $subscriber->id,
                'admin_id' => Auth::guard('admin')->user()->id ?? null,
                'action' => strtoupper($deployment) . 'ED',
                'after_status' => $subscriber->status,
                'details' => ['deployment' => $deployment]
            ]);

            return redirect()->back()->with('success', "Account successfully {$deployment}ed.");
        } catch (\Exception $e) {
            return redirect()->back()->with('message', "Failed to {$deployment} account: " . $e->getMessage());
        }
    }


    public function confirmsub($id)
    {
        //get the sub details
        $sub = Mt4Details::find($id);
        if (!$sub) return;

        //get user
        $user = User::where('id', $sub->client_id)->first();
        $settings = Settings::find(1);

        // STEP 1: Determine amount and deduct balance
        $amount = 0;
        if ($sub->duration == 'Monthly') {
            $amount = $settings->monthlyfee;
            $end_at = now()->addMonths(1);
        } elseif ($sub->duration == 'Quaterly') {
            $amount = $settings->quarterlyfee;
            $end_at = now()->addMonths(4);
        } elseif ($sub->duration == 'Yearly') {
            $amount = $settings->yearlyfee;
            $end_at = now()->addYears(1);
        }

        if ($user->account_bal < $amount) {
            return redirect()->back()->with('message', 'User balance is insufficient for this subscription.');
        }

        // STEP 2: Charge user
        $user->account_bal -= $amount;
        $user->save();

        // STEP 3: Create transaction record
        Tp_Transaction::create([
            'user' => $user->id,
            'plan' => "MT4 Trading Subscription Approved",
            'amount' => $amount,
            'type' => "MT4 Trading",
        ]);

        // STEP 4: Update MT4 details
        $remindAt = $end_at->subDays(10);
        $oldStatus = $sub->status;
        $sub->start_date = now();
        $sub->end_date =  $end_at;
        $sub->reminded_at = $remindAt;
        $sub->status = 'Active';
        $sub->save();

        // STEP 5: Audit Log
        Mt4TransactionLog::create([
            'subscriber_account_id' => $sub->id,
            'admin_id' => Auth::guard('admin')->user()->id ?? null,
            'action' => 'APPROVED',
            'before_status' => $oldStatus,
            'after_status' => 'Active',
            'details' => ['amount_charged' => $amount]
        ]);

        $message = "$user->name, This is to inform you that your trading account management request has been reviewed and processed. Your account is now active. Thank you for trusting $settings->site_name";
        Mail::to($user->email)->send(new NewNotification($message, 'Subscription Account Started!', $user->name));
    }

    public function updateAccountDetails(Request $request)
    {
        $account = Mt4Details::find($request->id);
        if (!$account) {
            return redirect()->back()->with('message', 'Account not found.');
        }

        $account->update([
            'status' => $request->status,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->back()->with('success', 'Account details updated successfully.');
    }

    public function stopCopying($id)
    {
        $account = Mt4Details::find($id);
        if (!$account) {
            return redirect()->back()->with('message', 'Account not found.');
        }

        $oldStatus = $account->status;

        $account->update([
            'status' => 'Expired',
            'copy_trade_enabled' => false,
            'deployment_status' => 'UNDEPLOYED'
        ]);

        if ($account->copyTradeRelationship) {
            $account->copyTradeRelationship->update([
                'status' => 'INACTIVE'
            ]);
        }

        Mt4TransactionLog::create([
            'subscriber_account_id' => $account->id,
            'admin_id' => Auth::guard('admin')->user()->id ?? null,
            'action' => 'STOPPED_COPYING',
            'before_status' => $oldStatus,
            'after_status' => 'Expired',
            'details' => ['reason' => 'Stopped manually by admin']
        ]);

        return redirect()->back()->with('success', 'Copy trading has been stopped successfully for this account.');
    }
}