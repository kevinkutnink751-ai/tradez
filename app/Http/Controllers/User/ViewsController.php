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
use App\Models\Asset;
use App\Models\MasterAccount;
use App\Models\OptionTrade;
use App\Models\TradingPair;
use App\Models\UserWallet;
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

        $marketPairs = TradingPair::with(['asset', 'quoteAssetModel'])
            ->where('status', true)
            ->get()
            ->filter(fn ($pair) => $pair->supportsMarket('spot') || $pair->supportsMarket('future'))
            ->sortByDesc(fn ($pair) => abs($pair->change_24h))
            ->take(6)
            ->values();

        //sum total profits
        $spot_profits = Trade::where('user_id', $user->id)->where('market_type', 'Spot')->sum('pnl');
        $future_profits = Trade::where('user_id', $user->id)->where('market_type', 'Future')->sum('pnl');
        $binary_profits = BinaryTrade::where('user_id', $user->id)->sum('win_amount');
        $option_profits = OptionTrade::where('user_id', $user->id)->sum('pnl');
        $total_profits = $spot_profits + $future_profits + $binary_profits + $option_profits;

        $copy_expert = DB::table('mt4_details')->where('client_id', $user->id)->where('account_type', 'Copy Trading')->first();

        // Calculate daily P&L for calendar
        $currentMonth = now()->month;
        $currentYear = now()->year;
        
        $dailyPnl = DB::table('trades')
            ->where('user_id', $user->id)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(pnl) as total_pnl'))
            ->groupBy('date')
            ->get()
            ->pluck('total_pnl', 'date');

        return view("user.dashboard", [
            'title' => 'Account Dashboard',
            'deposited' => $total_deposited,
            'total_withdrawal' => $total_withdrawal,
            'total_profits' => $total_profits,
            'copy_expert' => $copy_expert,
            'dailyPnl' => $dailyPnl,
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
            'marketPairs' => $marketPairs,
            'settings' => $settings,
        ]);
    }

    //Profile route
    public function assets()
    {
        $user = Auth::user();
        $assets = Asset::where('status', true)->get()->map(function ($asset) use ($user) {
            $wallet = UserWallet::where('user_id', $user->id)->where('asset_id', $asset->id)->first();
            $balance = $wallet ? ($wallet->spot_bal + $wallet->funding_bal + $wallet->future_bal + $wallet->copy_trade_bal) : 0;
            $estimated_usd = $balance * ($asset->base_rate ?: 1);
            
            return (object) [
                'id' => $asset->id,
                'name' => $asset->name,
                'symbol' => $asset->symbol,
                'category' => $asset->category,
                'type' => $asset->type,
                'logo' => $asset->logo,
                'balance' => $balance,
                'estimated_usd' => $estimated_usd,
                'rate' => $asset->base_rate,
            ];
        });

        $categories = [
            'Fiat' => $assets->where('type', 'Fiat'),
            'Crypto' => $assets->where('type', 'Crypto'),
            'Stocks' => $assets->filter(fn($a) => in_array($a->type, ['Equity', 'Index'])),
            'Commodities' => $assets->where('type', 'Commodity'),
            'Others' => $assets->filter(fn($a) => in_array($a->type, ['Rate', 'Volatility'])),
        ];

        return view('user.wallet.assets', [
            'title' => 'My Assets',
            'categories' => $categories,
            'all_assets' => $assets,
        ]);
    }

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
                'assets' => Asset::where('status', true)->orderBy('name')->get(),
                'selectedAsset' => Asset::where('id', request()->query('asset_id'))->first(),
                'selectedBalanceType' => request()->query('balance_type', 'funding'),
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
        $mode = request('mode', 'Live');
        $isDemo = $mode === 'Demo';
        $trades = Trade::where('user_id', Auth::user()->id)->where('status', 'Open')->where('is_demo', $isDemo)->orderByDesc('id')->get();
        return view('user.trading.manage_orders', [
            'title' => 'Manage Orders',
            'trades' => $trades,
            'currentMode' => $mode,
        ]);
    }

    public function spotTrade(Request $request)
    {
        $mod = Settings::where('id', 1)->first()->modules;
        if (isset($mod['spot']) && !$mod['spot']) {
            abort(404);
        }
        $pairs = TradingPair::with(['asset', 'quoteAssetModel'])->where('status', true)->get()->filter(fn ($pair) => $pair->supportsMarket('spot'))->values();
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
        $pairs = TradingPair::with(['asset', 'quoteAssetModel'])->where('status', true)->get()->filter(fn ($pair) => $pair->supportsMarket('binary'))->values();
        $selectedPair = $request->query('pair');
        $currentPair = $pairs->firstWhere('name', $selectedPair) ?? $pairs->first();

        return view('user.trading.binary', [
            'title' => 'Binary Trading',
            'pairs' => $pairs,
            'currentPair' => $currentPair,
        ]);
    }

    public function binaryHistory(Request $request)
    {
        $mod = Settings::where('id', 1)->first()->modules;
        if (isset($mod['binary']) && !$mod['binary']) {
            abort(404);
        }

        $mode = request('mode', 'Live');
        return redirect()->route('trade.history', ['type' => 'binary', 'mode' => $mode]);
    }
    


    public function futureTrade(Request $request)
    {
        $mod = Settings::where('id', 1)->first()->modules;
        if (isset($mod['future']) && !$mod['future']) {
            abort(404);
        }
        $pairs = TradingPair::with(['asset', 'quoteAssetModel'])->where('status', true)->get()->filter(fn ($pair) => $pair->supportsMarket('future'))->values();
        $selectedPair = $request->query('pair');
        $currentPair = $pairs->firstWhere('name', $selectedPair) ?? $pairs->first();
        
        $isDemo = $request->query('mode', 'Live') === 'Demo';

        $openPositions = Trade::with('tradingPair')
            ->where('user_id', Auth::id())
            ->where('market_type', 'Future')
            ->where('is_demo', $isDemo)
            ->where('status', 'Open')
            ->orderByDesc('id')
            ->get();

        $pendingOrders = Trade::with('tradingPair')
            ->where('user_id', Auth::id())
            ->where('market_type', 'Future')
            ->where('is_demo', $isDemo)
            ->where('status', 'Pending')
            ->orderByDesc('id')
            ->get();

        $tradeHistory = Trade::with('tradingPair')
            ->where('user_id', Auth::id())
            ->where('market_type', 'Future')
            ->where('is_demo', $isDemo)
            ->whereIn('status', ['Completed', 'Canceled'])
            ->orderByDesc('id')
            ->limit(50)
            ->get();

        return view('user.trading.future', [
            'title' => 'Future Trading',
            'pairs' => $pairs,
            'currentPair' => $currentPair,
            'openPositions' => $openPositions,
            'pendingOrders' => $pendingOrders,
            'tradeHistory' => $tradeHistory,
        ]);
    }

    public function futureHistory()
    {
        $mod = Settings::where('id', 1)->first()->modules;
        if (isset($mod['future']) && !$mod['future']) {
            abort(404);
        }
        $mode = request('mode', 'Live');
        return redirect()->route('trade.history', ['type' => 'futures', 'mode' => $mode]);
    }
    

    public function optionsTrade(Request $request)
    {
        $mod = Settings::where('id', 1)->first()->modules;
        if (isset($mod['options']) && !$mod['options']) {
            abort(404);
        }
        $pairs = TradingPair::with(['asset', 'quoteAssetModel'])->where('status', true)->get()->filter(fn ($pair) => $pair->supportsMarket('option'))->values();
        $selectedPair = $request->query('pair');
        $currentPair = $pairs->firstWhere('name', $selectedPair) ?? $pairs->first();

        $currentPrice = $currentPair->last_price ?: 1.0;
        $strikes = [];
        $intervals = [0.98, 0.99, 1.0, 1.01, 1.02]; // -2%, -1%, Current, +1%, +2%
        foreach($intervals as $i) {
            $strike = $currentPrice * $i;
            $strikes[] = [
                'price' => $strike,
                'call_premium' => ($currentPrice * 0.05) / $i, // dummy calculation
                'put_premium' => ($currentPrice * 0.05) * $i, // dummy calculation
                'delta' => 0.5 + (1 - $i) * 10,
                'theta' => -0.02 * $i
            ];
        }


        return view('user.trading.options', [
            'title' => 'Options Trading',
            'pairs' => $pairs,
            'currentPair' => $currentPair,
            'strikes' => $strikes,
        ]);

    }

    public function optionsHistory(Request $request)
    {
        $mod = Settings::where('id', 1)->first()->modules;
        if (isset($mod['options']) && !$mod['options']) {
            abort(404);
        }

        $mode = request('mode', 'Live');
        return redirect()->route('trade.history', ['type' => 'options', 'mode' => $mode]);
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
        $mode = request('mode', 'Live');
        return redirect()->route('trade.history', ['type' => 'spot', 'mode' => $mode]);
    }
    

    public function allTradeHistory(Request $request)
    {
        $mode = $request->query('mode', 'Live');
        $isDemo = $mode === 'Demo';
        $tradeType = $request->query('type', 'all');

        $allTrades = collect();

        // Binary Trades
        if (in_array($tradeType, ['all', 'binary'])) {
            $binaryTrades = BinaryTrade::where('user_id', Auth::id())
                ->where('is_demo', $isDemo)
                ->orderByDesc('created_at')
                ->get()
                ->map(function ($t) {
                    return (object) [
                        'id' => 'BIN-' . $t->id,
                        'raw_id' => $t->id,
                        'trade_type' => 'Binary',
                        'pair' => $t->coin_pair,
                        'side' => $t->direction,
                        'amount' => $t->amount,
                        'price' => $t->strike_price,
                        'pnl' => $t->win_amount ?? 0,
                        'leverage' => null,
                        'status' => $t->status,
                        'result' => $t->result,
                        'is_demo' => $t->is_demo,
                        'duration' => $t->duration . 's',
                        'expiration' => null,
                        'strike_price' => $t->strike_price,
                        'end_price' => $t->end_price,
                        'settlement_asset' => 'USD',
                        'order_type' => 'Market',
                        'created_at' => $t->created_at,
                        'updated_at' => $t->updated_at,
                    ];
                });
            $allTrades = $allTrades->merge($binaryTrades);
        }

        // Options Trades
        if (in_array($tradeType, ['all', 'options'])) {
            $optionTrades = OptionTrade::where('user_id', Auth::id())
                ->where('is_demo', $isDemo)
                ->orderByDesc('created_at')
                ->get()
                ->map(function ($t) {
                    return (object) [
                        'id' => 'OPT-' . $t->id,
                        'raw_id' => $t->id,
                        'trade_type' => 'Options',
                        'pair' => $t->pair,
                        'side' => $t->type,
                        'amount' => $t->amount,
                        'price' => $t->strike_price,
                        'pnl' => $t->pnl,
                        'leverage' => null,
                        'status' => $t->status,
                        'result' => $t->status,
                        'is_demo' => $t->is_demo,
                        'duration' => null,
                        'expiration' => $t->expiration,
                        'strike_price' => $t->strike_price,
                        'end_price' => null,
                        'settlement_asset' => 'USD',
                        'order_type' => 'Market',
                        'created_at' => $t->created_at,
                        'updated_at' => $t->updated_at,
                    ];
                });
            $allTrades = $allTrades->merge($optionTrades);
        }

        // Futures Trades
        if (in_array($tradeType, ['all', 'futures'])) {
            $futureTrades = Trade::where('user_id', Auth::id())
                ->where('market_type', 'Future')
                ->where('is_demo', $isDemo)
                ->orderByDesc('created_at')
                ->get()
                ->map(function ($t) {
                    return (object) [
                        'id' => 'FUT-' . $t->id,
                        'raw_id' => $t->id,
                        'trade_type' => 'Futures',
                        'pair' => $t->pair,
                        'side' => $t->type,
                        'amount' => $t->amount,
                        'price' => $t->price,
                        'pnl' => $t->pnl,
                        'leverage' => $t->leverage,
                        'status' => $t->status,
                        'result' => $t->status,
                        'is_demo' => $t->is_demo,
                        'duration' => null,
                        'expiration' => null,
                        'strike_price' => null,
                        'end_price' => null,
                        'settlement_asset' => $t->settlement_asset ?? 'USD',
                        'order_type' => $t->order_type,
                        'created_at' => $t->created_at,
                        'updated_at' => $t->updated_at,
                    ];
                });
            $allTrades = $allTrades->merge($futureTrades);
        }

        // Spot Trades
        if (in_array($tradeType, ['all', 'spot'])) {
            $spotTrades = Trade::where('user_id', Auth::id())
                ->where('market_type', 'Spot')
                ->where('is_demo', $isDemo)
                ->orderByDesc('created_at')
                ->get()
                ->map(function ($t) {
                    return (object) [
                        'id' => 'SPT-' . $t->id,
                        'raw_id' => $t->id,
                        'trade_type' => 'Spot',
                        'pair' => $t->pair,
                        'side' => $t->type,
                        'amount' => $t->amount,
                        'price' => $t->price,
                        'pnl' => $t->pnl,
                        'leverage' => 1,
                        'status' => $t->status,
                        'result' => $t->status,
                        'is_demo' => $t->is_demo,
                        'duration' => null,
                        'expiration' => null,
                        'strike_price' => null,
                        'end_price' => null,
                        'settlement_asset' => $t->settlement_asset ?? 'USD',
                        'order_type' => 'Market',
                        'created_at' => $t->created_at,
                        'updated_at' => $t->updated_at,
                    ];
                });
            $allTrades = $allTrades->merge($spotTrades);
        }

        $allTrades = $allTrades->sortByDesc('created_at')->values();

        $stats = [
            'total_trades' => $allTrades->count(),
            'total_invested' => $allTrades->sum('amount'),
            'total_pnl' => $allTrades->sum('pnl'),
            'binary_count' => $allTrades->where('trade_type', 'Binary')->count(),
            'options_count' => $allTrades->where('trade_type', 'Options')->count(),
            'futures_count' => $allTrades->where('trade_type', 'Futures')->count(),
            'spot_count' => $allTrades->where('trade_type', 'Spot')->count(),
            'open_count' => $allTrades->where('status', 'Open')->count(),
        ];

        return view('user.trading.trade_history', [
            'title' => 'Trade History',
            'trades' => $allTrades,
            'currentMode' => $mode,
            'currentType' => $tradeType,
            'stats' => $stats,
        ]);
    }
}
