<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CryptoAccount;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Settings;
use App\Models\Plans;
use App\Models\User_plans;
use App\Models\Mt4Details;
use App\Models\Deposit;
use App\Models\SettingsCont;
use App\Models\Wdmethod;
use App\Models\Withdrawal;
use App\Models\Tp_Transaction;
use App\Models\BinaryTrade;
use App\Models\Trade;
use App\Models\MasterAccount;
use App\Models\OptionTrade;
use App\Models\TradingPair;
use App\Traits\PingServer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ViewsController extends Controller
{
    use PingServer;

    public function dashboard(Request $request)
    {

        $settings = Settings::where('id', '1')->first();
        $user = User::find(auth()->user()->id);

        //check if user does not have ref link then update his link
        if ($user->ref_link == '') {
            User::where('id', $user->id)
                ->update([
                    'ref_link' => $settings->site_address . '/ref/' . $user->username,
                ]);
        }

        //give reg bonus if new
        if ($user->signup_bonus != "received" && ($settings->signup_bonus != NULL && $settings->signup_bonus > 0)) {
            User::where('id', $user->id)
                ->update([
                    'bonus' => $user->bonus + $settings->signup_bonus,
                    'account_bal' => $user->account_bal + $settings->signup_bonus,
                    'signup_bonus' => "received",
                ]);
            //create history
            Tp_Transaction::create([
                'user' => Auth::user()->id,
                'plan' => "SignUp Bonus",
                'amount' => $settings->signup_bonus,
                'type' => "Bonus",
            ]);
        }

        if (DB::table('crypto_accounts')->where('user_id', Auth::user()->id)->doesntExist()) {
            $cryptoaccnt = new CryptoAccount();
            $cryptoaccnt->user_id = Auth::user()->id;
            $cryptoaccnt->save();
        }

        //sum total deposited
        $total_deposited = DB::table('deposits')->where('user', $user->id)->where('status', 'Processed')->sum('amount');

        $total_withdrawal = DB::table('withdrawals')->where('user', $user->id)->where('status', 'Processed')->sum('amount');

        //log user out if not blocked by admin
        if ($user->status != "active") {
            $request->session()->flush();
            return redirect()->route('dashboard');
        }

        return view("user.dashboard", [
            'title' => 'Account Dashboard',
            'deposited' => $total_deposited,
            'total_withdrawal' => $total_withdrawal,
            'trading_accounts' => Mt4Details::where('client_id', Auth::user()->id)->count(),
            'plans' => User_plans::where('user', Auth::user()->id)->where('active', 'yes')->orderByDesc('id')->skip(0)->take(2)->get(),
            't_history' => Tp_Transaction::where('user', Auth::user()->id)
                ->where('type', '<>', 'ROI')
                ->orderByDesc('id')->skip(0)->take(10)
                ->get(),
            'open_orders_count' => Trade::where('user_id', Auth::user()->id)->where('status', 'Open')->count(),
            'completed_orders_count' => Trade::where('user_id', Auth::user()->id)->where('status', 'Completed')->count(),
            'canceled_orders_count' => Trade::where('user_id', Auth::user()->id)->where('status', 'Canceled')->count(),
            'total_trades_count' => Trade::where('user_id', Auth::user()->id)->count(),
            'recent_orders' => Trade::where('user_id', Auth::user()->id)->orderByDesc('id')->limit(5)->get(),
        ]);
    }

    //Profile route
    public function profile()
    {
        $userinfo = User::where('id', Auth::user()->id)->first();

        $paymethods = Wdmethod::select(['status', 'name'])->where(function ($query) {
            $query->where('type', '=', 'withdrawal')
                ->orWhere('type', '=', 'both');
        })->whereIn('name', ['Bitcoin', 'Ethereum', 'Litecoin', 'Bank Transfer', 'USDT'])->get();

        return view("user.profile")->with(array(
            'userinfo' => $userinfo,
            'methods' => $paymethods,
            'title' => 'Profile',
        ));
    }

    //return add withdrawal account form view
    public function accountdetails()
    {
        return view("user.updateacct")->with(array(
            'title' => 'Update account details',
        ));
    }


    //support route
    public function support()
    {
        return view("user.support")
            ->with(array(
                'title' => 'Support',
            ));
    }

    //Trading history route
    public function tradinghistory()
    {
        return view("user.thistory")
            ->with(array(
                't_history' => Tp_Transaction::where('user', Auth::user()->id)
                    ->where('type', 'ROI')
                    ->orderByDesc('id')
                    ->paginate(15),
                'title' => 'Trading History',
            ));
    }

    //Account transactions history route
    public function accounthistory()
    {
        return view("user.transactions")
            ->with(array(
                't_history' => Tp_Transaction::where('user', Auth::user()->id)
                    ->where('type', '<>', 'ROI')
                    ->orderByDesc('id')
                    ->get(),

                'withdrawals' => Withdrawal::where('user', Auth::user()->id)->orderBy('id', 'desc')
                    ->get(),
                'deposits' => Deposit::where('user', Auth::user()->id)->orderBy('id', 'desc')
                    ->get(),
                'title' => 'Account Transactions History',

            ));
    }

    //Return deposit route
    public function deposits()
    {
        $paymethod = Wdmethod::where(function ($query) {
            $query->where('type', '=', 'deposit')
                ->orWhere('type', '=', 'both');
        })->where('status', 'enabled')->orderByDesc('id')->get();

        //sum total deposited
        $total_deposited = DB::table('deposits')->where('user', auth()->user()->id)->where('status', 'Processed')->sum('amount');

        return view("user.deposits")
            ->with(array(
                'title' => 'Fund your account',
                'dmethods' => $paymethod,
                'deposits' => Deposit::where(['user' => Auth::user()->id])
                    ->orderBy('id', 'desc')
                    ->get(),
                'deposited' => $total_deposited,
            ));
    }

    //Return withdrawals route
    public function withdrawals()
    {
        $withdrawals =  Wdmethod::where(function ($query) {
            $query->where('type', '=', 'withdrawal')
                ->orWhere('type', '=', 'both');
        })->where('status', 'enabled')->orderByDesc('id')->get();

        return view("user.withdrawals")
            ->with(array(
                'title' => 'Withdraw Your funds',
                'wmethods' => $withdrawals,
            ));
    }

    public function transferview()
    {
        $settings = SettingsCont::find(1);
        if (!$settings->use_transfer) {
            abort(404);
        }
        return view("user.transfer", [
            'title' => 'Send funds to a friend',
        ]);
    }

    //Subscription Trading 
    public function subtrade()
    {
        $settings = Settings::where('id', 1)->first();
        $mod = $settings->modules;
        if (!$mod['subscription']) {
            abort(404);
        }

        $subscriptions = Mt4Details::where('client_id', Auth::user()->id)
            ->with(['copyTradeLogs' => function($query) {
                $query->with('signal')->orderBy('created_at', 'desc')->limit(10);
            }])
            ->orderBy('id', 'desc')
            ->get();

        // Calculate aggregate stats for the user
        $stats = [
            'total_accounts' => $subscriptions->count(),
            'active_accounts' => $subscriptions->where('status', 'Active')->count(),
            'total_profit' => $subscriptions->sum('total_profit'),
            'total_trades' => $subscriptions->sum('total_trades'),
        ];

        return view("user.subtrade", [
            'title' => 'Managed Accounts',
            'subscriptions' => $subscriptions,
            'stats' => $stats,
            'settings' => $settings,
        ]);
    }


    //Main Plans route
    public function mplans()
    {
        return view("user.mplans")
            ->with(array(
                'title' => 'Main Plans',
                'plans' => Plans::where('type', 'main')->get(),
                'settings' => Settings::where('id', '1')->first(),
            ));
    }

    //My Plans route
    public function myplans($sort)
    {
        if ($sort == 'All') {
            return view("user.myplans")
                ->with(array(
                    'numOfPlan' => User_plans::where('user', Auth::user()->id)->count(),
                    'title' => 'Your packages',
                    'plans' => User_plans::where('user', Auth::user()->id)->orderByDesc('id')->paginate(10),
                    'settings' => Settings::where('id', '1')->first(),
                ));
        } else {
            return view("user.myplans")
                ->with(array(
                    'numOfPlan' => User_plans::where('user', Auth::user()->id)->count(),
                    'title' => 'Your packages',
                    'plans' => User_plans::where('user', Auth::user()->id)->where('active', $sort)->orderByDesc('id')->paginate(10),
                    'settings' => Settings::where('id', '1')->first(),
                ));
        }
    }


    public function sortPlans($sort)
    {
        return redirect()->route('myplans', ['sort' => $sort]);
    }

    public function planDetails($id)
    {
        $plan = User_plans::find($id);
        return view("user.plandetails", [
            'title' => $plan->dplan->name,
            'plan' => $plan,
            'transactions' => Tp_Transaction::where('type', 'ROI')->where('user_plan_id', $plan->id)->orderByDesc('id')->paginate(10),
        ]);
    }


    function twofa()
    {
        return view("profile.show", [
            'title' => 'Advance Security Settings',
        ]);
    }

    // Referral Page
    public function referuser()
    {
        return view("user.referuser", [
            'title' => 'Refer user',
        ]);
    }

    public function verifyaccount()
    {
        if (Auth::user()->account_verify == 'Verified') {
            abort(404, 'You do not have permission to access this page');
        }
        return view("user.verify", [
            'title' => 'Verify your Account',
        ]);
    }

    public function verificationForm()
    {
        if (Auth::user()->account_verify == 'Verified') {
            abort(404, 'You do not have permission to access this page');
        }
        return view("user.verification", [
            'title' => 'KYC Application'
        ]);
    }



    public function tradeSignals()
    {
        $settings = Settings::where('id', 1)->first();
        $mod = $settings->modules;
        if (!$mod['signal']) {
            abort(404);
        }

        // $response = $this->fetctApi('/subscription', [
        //     'id' => auth()->user()->id
        // ]);
        // $res = json_decode($response);
        #NOTE: Create a signals_subscriptions table to store subscription data
        $res = [
            "amount_paid" => "32",
            "subscription" => "Monthly",
            "reminded_at" => now(),
            "expired_at" => now()->addMonth(),
            "currency" => "USD",
        ];
        $res = (object) $res;
        #NOTE: add signal settings to settings for local storage

        // $responseSt = $this->fetctApi('/signal-settings');
        // $info = json_decode($responseSt);

        $signalSettings = [
            "signal_monthly_fee" => "32",
            "signal_quarterly_fee" => "96",
            "signal_yearly_fee" => "384",
        ];
        $signalSettings = (object) $signalSettings;

        return view("user.signals.subscribe", [
            'title' => 'Trade signals',
            'subscription' => $res,
            'set' => $signalSettings,
        ]);
    }


    public function binanceSuccess()
    {
        return redirect()->route('deposits')->with('success', 'Your Deposit was successful, please wait while it is confirmed. You will receive a notification regarding the status of your deposit.');
    }

    public function binanceError()
    {
        return redirect()->route('deposits')->with('message', 'Something went wrong please try again. Contact our support center if problem persist');
    }

    public function manageOrder()
    {
        $mod = Settings::where('id', 1)->first()->modules;
        if ((isset($mod['spot']) && !$mod['spot']) && (isset($mod['future']) && !$mod['future'])) {
            abort(404);
        }
        $trades = Trade::where('user_id', Auth::user()->id)->where('status', 'Open')->orderByDesc('id')->get();
        return view('user.trading.manage_orders', [
            'title' => 'Manage Orders',
            'trades' => $trades,
        ]);
    }

    public function spotTrade(Request $request)
    {
        $mod = Settings::where('id', 1)->first()->modules;
        if (isset($mod['spot']) && !$mod['spot']) {
            abort(404);
        }
        $pairs = TradingPair::with(['asset', 'quoteAssetModel'])->where('type', 'Spot')->where('status', true)->get();
        $selectedPair = $request->query('pair');
        $currentPair = $pairs->firstWhere('name', $selectedPair) ?? $pairs->first();
        
        return view('user.trading.spot', [
            'title' => 'Spot Trading',
            'pairs' => $pairs,
            'currentPair' => $currentPair,
        ]);
    }

    public function binaryTrade(Request $request)
    {
        $mod = Settings::where('id', 1)->first()->modules;
        if (isset($mod['binary']) && !$mod['binary']) {
            abort(404);
        }
        $pairs = TradingPair::with(['asset', 'quoteAssetModel'])->where('type', 'Binary')->where('status', true)->get();
        $selectedPair = $request->query('pair');
        $currentPair = $pairs->firstWhere('name', $selectedPair) ?? $pairs->first();

        return view('user.trading.binary', [
            'title' => 'Binary Trading',
            'pairs' => $pairs,
            'currentPair' => $currentPair,
        ]);
    }

    public function binaryHistory()
    {
        $mod = Settings::where('id', 1)->first()->modules;
        if (isset($mod['binary']) && !$mod['binary']) {
            abort(404);
        }
        $trades = BinaryTrade::where('user_id', Auth::user()->id)->orderByDesc('id')->paginate(20);
        return view('user.trading.binary_history', [
            'title' => 'Binary Trade History',
            'trades' => $trades,
        ]);
    }

    public function futureTrade(Request $request)
    {
        $mod = Settings::where('id', 1)->first()->modules;
        if (isset($mod['future']) && !$mod['future']) {
            abort(404);
        }
        $pairs = TradingPair::with(['asset', 'quoteAssetModel'])->where('type', 'Future')->where('status', true)->get();
        $selectedPair = $request->query('pair');
        $currentPair = $pairs->firstWhere('name', $selectedPair) ?? $pairs->first();
        $openPositions = Trade::with('tradingPair')
            ->where('user_id', Auth::id())
            ->where('market_type', 'Future')
            ->where('status', 'Open')
            ->orderByDesc('id')
            ->get();

        return view('user.trading.future', [
            'title' => 'Future Trading',
            'pairs' => $pairs,
            'currentPair' => $currentPair,
            'openPositions' => $openPositions,
        ]);
    }

    public function futureHistory()
    {
        $mod = Settings::where('id', 1)->first()->modules;
        if (isset($mod['future']) && !$mod['future']) {
            abort(404);
        }
        $trades = Trade::where('user_id', Auth::user()->id)
            ->where('market_type', 'Future')
            ->orderByDesc('id')
            ->get();
            
        return view('user.trading.future_history', [
            'title' => 'Future Trading History',
            'trades' => $trades,
        ]);
    }

    public function optionsTrade(Request $request)
    {
        $mod = Settings::where('id', 1)->first()->modules;
        if (isset($mod['options']) && !$mod['options']) {
            abort(404);
        }
        $pairs = TradingPair::with(['asset', 'quoteAssetModel'])->where('type', 'Option')->where('status', true)->get();
        $selectedPair = $request->query('pair');
        $currentPair = $pairs->firstWhere('name', $selectedPair) ?? $pairs->first();

        return view('user.trading.options', [
            'title' => 'Options Trading',
            'pairs' => $pairs,
            'currentPair' => $currentPair,
        ]);
    }

    public function optionsHistory()
    {
        $mod = Settings::where('id', 1)->first()->modules;
        if (isset($mod['options']) && !$mod['options']) {
            abort(404);
        }
        $trades = OptionTrade::where('user_id', Auth::user()->id)
            ->orderByDesc('id')
            ->get();
            
        return view('user.trading.options_history', [
            'title' => 'Options Trading History',
            'trades' => $trades,
        ]);
    }

    public function copyTrade()
    {
        $masters = MasterAccount::all();
        return view('user.copytrade.index', [
            'title' => 'Copy Trading',
            'masters' => $masters,
        ]);
    }

    public function mySubscriptions()
    {
        $user = Auth::user();
        $subscriptions = \App\Models\Mt4Details::where('client_id', $user->id)
            ->where('account_type', 'Copy Trading')
            ->with(['masterAccount', 'copyTradeRelationship'])
            ->orderBy('id', 'desc')
            ->get();

        return view('user.copytrade.subscriptions', [
            'title' => 'My Subscriptions',
            'subscriptions' => $subscriptions,
        ]);
    }

    public function p2pCenter()
    {
        return view('user.p2p.index', [
            'title' => 'P2P Center',
        ]);
    }

    public function manageWallet()
    {
        return view('user.wallet.index', [
            'title' => 'Manage Wallet',
        ]);
    }

    public function depositHistory()
    {
        $deposits = Deposit::where('user', Auth::user()->id)->orderByDesc('id')->paginate(20);
        return view('user.history.deposits', [
            'title' => 'Deposit History',
            'deposits' => $deposits,
        ]);
    }

    public function withdrawHistory()
    {
        $withdrawals = Withdrawal::where('user', Auth::user()->id)->orderByDesc('id')->paginate(20);
        return view('user.history.withdrawals', [
            'title' => 'Withdraw History',
            'withdrawals' => $withdrawals,
        ]);
    }
    public function spotHistory()
    {
        $trades = Trade::where('user_id', Auth::user()->id)
            ->where('market_type', 'spot')
            ->orderByDesc('id')
            ->get();
            
        return view('user.trading.spot_history', [
            'title' => 'Spot Trading History',
            'trades' => $trades,
        ]);
    }
}
