<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Settings;
use App\Models\Plans;
use App\Models\Faq;
use App\Models\Testimony;
use App\Models\Deposit;
use App\Models\Withdrawal;
use App\Models\TermsPrivacy;
use Illuminate\Support\Facades\DB;
use App\Mail\NewNotification;
use Illuminate\Support\Facades\Mail;
use App\Models\MasterAccount;

class HomePageController extends Controller
{
    public function index()
    {
        $settings = Settings::where('id', '=', '1')->first();
        $total_deposits = DB::table('deposits')->select(DB::raw("SUM(amount) as total"))->where('status', 'Processed')->get();
        $total_withdrawals = DB::table('withdrawals')->select(DB::raw("SUM(amount) as total"))->where('status', 'Processed')->get();

        return view('home.index')->with(array(
            'settings' => $settings,
            'total_users' => User::count(),
            'plans' => Plans::all(),
            'total_deposits' => $total_deposits,
            'total_withdrawals' => $total_withdrawals,
            'faqs' => Faq::orderby('id', 'desc')->get(),
            'test' => Testimony::orderby('id', 'desc')->get(),
            'withdrawals' => Withdrawal::orderby('id', 'DESC')->take(7)->get(),
            'deposits' => Deposit::orderby('id', 'DESC')->take(7)->get(),
            'title' => $settings->site_title,
            'mplans' => Plans::where('type', 'Main')->get(),
            'pplans' => Plans::where('type', 'Promo')->get(),
        ));
    }

    public function licensing()
    {
        return view('home.licensing')->with(array(
            'mplans' => Plans::where('type', 'Main')->get(),
            'pplans' => Plans::where('type', 'Promo')->get(),
            'title' => 'Licensing, regulation and registration',
            'settings' => Settings::where('id', '=', '1')->first(),
        ));
    }

    public function terms()
    {
        return view('home.terms')->with(array(
            'mplans' => Plans::where('type', 'Main')->get(),
            'title' => 'Terms of Service',
            'settings' => Settings::where('id', '=', '1')->first(),
        ));
    }

    public function privacy()
    {
        $terms = TermsPrivacy::find(1);
        if ($terms->useterms == 'no') {
            return redirect()->back();
        }
        return view('home.privacy')->with(array(
            'mplans' => Plans::where('type', 'Main')->get(),
            'title' => 'Privacy Policy',
            'settings' => Settings::where('id', '=', '1')->first(),
        ));
    }

    public function faq()
    {
        return view('home.faq')->with(array(
            'title' => 'FAQs',
            'faqs' => Faq::orderby('id', 'desc')->get(),
            'settings' => Settings::where('id', '=', '1')->first(),
        ));
    }

    public function about()
    {
        return view('home.about')->with(array(
            'mplans' => Plans::where('type', 'Main')->get(),
            'title' => 'About',
            'settings' => Settings::where('id', '=', '1')->first(),
        ));
    }

    public function contact()
    {
        return view('home.contact')->with(array(
            'mplans' => Plans::where('type', 'Main')->get(),
            'pplans' => Plans::where('type', 'Promo')->get(),
            'title' => 'Contact',
            'settings' => Settings::where('id', '=', '1')->first(),
        ));
    }

    public function sendcontact(Request $request)
    {
        $settings = Settings::where('id', '1')->first();
        $message = substr(wordwrap($request['message'], 70), 0, 350);
        $subject = "$request->subject, my email $request->email";
        Mail::to($settings->contact_email)->send(new NewNotification($message, $subject, 'Admin'));
        return redirect()->back()->with('success', ' Your message was sent successfully!');
    }

    public function optionCopy()
    {
        return view('home.products.option-copy')->with([
            'settings' => Settings::where('id', '=', '1')->first(),
        ]);
    }

    public function advanceTrading()
    {
        return view('home.products.advance-trading')->with([
            'settings' => Settings::where('id', '=', '1')->first(),
        ]);
    }

    public function liveTrading()
    {
        return view('home.products.live-trading')->with([
            'settings' => Settings::where('id', '=', '1')->first(),
        ]);
    }

    public function futuresTrading()
    {
        return view('home.products.futures')->with([
            'settings' => Settings::where('id', '=', '1')->first(),
        ]);
    }

    public function optionsTrading()
    {
        return view('home.products.options')->with([
            'settings' => Settings::where('id', '=', '1')->first(),
        ]);
    }

    public function binaryTrading()
    {
        return view('home.products.binary')->with([
            'settings' => Settings::where('id', '=', '1')->first(),
        ]);
    }

    public function spotTrading()
    {
        return view('home.products.spot')->with([
            'settings' => Settings::where('id', '=', '1')->first(),
        ]);
    }

    public function expertMirroring()
    {
        return view('home.products.mirroring')->with([
            'settings' => Settings::where('id', '=', '1')->first(),
        ]);
    }

    public function strategyMarketplace()
    {
        return view('home.products.strategy')->with([
            'settings' => Settings::where('id', '=', '1')->first(),
        ]);
    }

    public function forexTrading()
    {
        return view('home.products.forex')->with([
            'settings' => Settings::where('id', '=', '1')->first(),
        ]);
    }

    public function insurance()
    {
        return view('home.insurance')->with([
            'settings' => Settings::where('id', '=', '1')->first(),
        ]);
    }

    public function regulations()
    {
        return view('home.regulations')->with([
            'settings' => Settings::where('id', '=', '1')->first(),
        ]);
    }

    public function security()
    {
        return view('home.security')->with([
            'settings' => Settings::where('id', '=', '1')->first(),
        ]);
    }

    public function masterAccount()
    {
        return view('home.master-account')->with([
            'settings' => Settings::where('id', '=', '1')->first(),
            'masters' => MasterAccount::where('is_active', true)->get(),
        ]);
    }
}
