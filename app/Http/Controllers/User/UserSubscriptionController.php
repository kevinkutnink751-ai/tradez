<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\NewNotification;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mt4Details;
use App\Models\Settings;
use App\Models\Tp_Transaction;
use App\Models\Mt4TransactionLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\CopyTradeRelationship;
use App\Models\MasterAccount;
use Illuminate\Support\Facades\Crypt;

class UserSubscriptionController extends Controller
{
    public function subscribeToMaster(Request $request)
    {
        $request->validate([
            'master_id' => 'required|exists:master_accounts,id',
            'amount' => 'required|numeric|min:1',
            'duration' => 'required|in:Monthly,Quaterly,Yearly'
        ]);

        $user = Auth::user();
        $amount = intval($request->amount);

        // Check balance
        if ($user->account_bal < $amount) {
            return redirect()->back()->with('message', 'Sorry, your account balance is insufficient for this subscription.');
        }

        // Deduct balance
        $user->account_bal -= $amount;
        $user->save();

        // Create transaction record
        Tp_Transaction::create([
            'user' => $user->id,
            'plan' => "Copy Trading Subscription",
            'amount' => $amount,
            'type' => "Copy Trading",
        ]);

        // Calculate end date based on duration
        if ($request->duration == 'Monthly') {
            $end_at = now()->addMonths(1);
        } elseif ($request->duration == 'Quaterly') {
            $end_at = now()->addMonths(4);
        } elseif ($request->duration == 'Yearly') {
            $end_at = now()->addYears(1);
        }

        $remindAt = $end_at->subDays(10);

        // Create virtual subscriber account (Mt4Details)
        $sub = new Mt4Details;
        $sub->client_id = $user->id;
        $sub->account_name = 'Virtual Copy Account';
        $sub->account_type = 'Copy Trading';
        $sub->duration = $request->duration;
        $sub->status = 'Active';
        $sub->deployment_status = 'Deployed';
        $sub->start_date = now();
        $sub->end_date = $end_at;
        $sub->reminded_at = $remindAt;
        $sub->balance = $amount; // They are allocating this amount to the copy trade
        $sub->master_account_id = $request->master_id;
        $sub->copy_trade_enabled = true;
        $sub->save();

        // Create the copy trade relationship
        CopyTradeRelationship::create([
            'subscriber_account_id' => $sub->id,
            'master_account_id' => $request->master_id,
            'status' => 'ACTIVE',
            'risk_settings' => [
                'sizing_strategy' => 'exact',
                'volume_multiplier' => 1.0,
            ],
            'enabled_at' => now(),
        ]);

        // Audit Log
        Mt4TransactionLog::create([
            'subscriber_account_id' => $sub->id,
            'user_id' => $user->id,
            'action' => 'SUBSCRIBED',
            'after_status' => 'Active',
            'details' => [
                'amount_allocated' => $amount,
                'master_id' => $request->master_id
            ]
        ]);

        return redirect()->route('user.my.subscriptions')->with('success', 'You have successfully subscribed to the master trader.');
    }
    //Save MT4 details to database
    public function savemt4details(Request $request)
    {
        // STEP 1: Basic balance check
        if (intval($request->amount) > 0 && (Auth::user()->account_bal < intval($request->amount))) {
            return redirect()->back()
                ->with('message', 'Sorry, your account balance is insufficient for this request.');
        }

        // TODO: implement internal mt4 details validation later
        /*
        if (strlen($request['pswrd']) < 6) {
            return redirect()->back()
                ->with('message', 'MT4 password must be at least 6 characters.');
        }
        */

        // STEP 3: Create Mt4Details record (No charge yet!)
        $mt4 = new Mt4Details;
        $mt4->client_id = Auth::user()->id;
        $mt4->mt4_id = $request['userid'];
        $mt4->mt4_password =  $request['pswrd'];
        $mt4->account_type = $request['acntype'];
        $mt4->account_name = $request['name'];
        $mt4->currency = $request['currency'];
        $mt4->leverage = $request['leverage'];
        $mt4->server = $request['server'];
        $mt4->duration = $request['duration'];
        $mt4->status = 'CREDENTIALS_VERIFIED'; // New status
        $mt4->verified_at = now();
        $mt4->save();

        // STEP 5: Create Audit Log
        Mt4TransactionLog::create([
            'subscriber_account_id' => $mt4->id,
            'user_id' => Auth::user()->id,
            'action' => 'CREDENTIALS_SUBMITTED',
            'after_status' => 'CREDENTIALS_VERIFIED',
            'details' => [
                'amount_pending' => $request->amount,
            ]
        ]);

        $settings = Settings::find(1);
        $user = Auth::user();

        $messaege = "This to notify you that $user->name submitted MT4 details for trading and credentials have been VERIFIED. Please login to APPROVE and charge the user.";
        Mail::to($settings->contact_email)->send(new NewNotification($messaege, 'MT4 Details Verified', 'Admin'));

        return redirect()->back()
            ->with('success', 'Your MT4 credentials have been verified. Your subscription will be activated once an administrator approves the request and processes the payment.');
    }

    // Delete mt4 details
    public function delsubtrade($id)
    {
        Mt4Details::find($id)->delete();
        return redirect()->back()
            ->with('success', 'MT4 Details Sucessfully Deleted');
    }

    public function renewSubscription($id)
    {
        $account = Mt4Details::find($id);
        $user = User::find(Auth::user()->id);
        $settings = Settings::find(1);

        if ($account->duration == 'Monthly') {
            $amount = $settings->monthlyfee;
            $end_at = $account->end_date->addMonths(1);
        } elseif ($account->duration == 'Quaterly') {
            $amount = $settings->quarterlyfee;
            $end_at = $account->end_date->addMonths(4);
        } elseif ($account->duration == 'Yearly') {
            $amount = $settings->yearlyfee;
            $end_at = $account->end_date->addYears(1);
        }

        $remindAt = $end_at->subDays(10);

        if ($amount > $user->account_bal) {
            return redirect()->back()->with('message', 'Your account balance is insufficient to renew your subscription, please make a deposit.');
        }

        $user->account_bal = $user->account_bal - $amount;
        $user->save();

        $account->start_date = now();
        $account->end_date =  $end_at;
        $account->reminded_at = $remindAt;
        $account->status = 'Active';
        $account->save();

        //send email to user
        $messageUser = "Your subscription with MT4-ID: $account->mt4_id is renewed succesfully.";
        Mail::to($account->tuser->email)->send(new NewNotification($messageUser, 'Your subscription have been renewed', $user->firstname));

        // Send email to admin
        $messageAdmin = "Subscription with MT4-ID: $amount->mt4_id have been renewed successfully.";
        Mail::to($settings->contact_email)->send(new NewNotification($messageAdmin, 'Subscription have been renewed', 'Admin'));

        return redirect()->back()->with('success', 'Your subcription have been renewed successfully.');
    }
}