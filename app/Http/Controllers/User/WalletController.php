<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserWallet;
use App\Models\Asset;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $wallets = $user->wallets()->with('asset')->get();
        
        $availableAssets = Asset::where('status', true)
            ->whereNotIn('id', $wallets->pluck('asset_id'))
            ->get();
            
        return view('user.wallets.index', [
            'title' => 'My Wallets',
            'wallets' => $wallets,
            'availableAssets' => $availableAssets
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'asset_id' => 'required|exists:assets,id'
        ]);

        $user = Auth::user();
        
        // Ensure wallet doesn't already exist
        if ($user->wallets()->where('asset_id', $request->asset_id)->exists()) {
            return redirect()->back()->with('message', 'Wallet already exists for this asset.');
        }

        UserWallet::create([
            'user_id' => $user->id,
            'asset_id' => $request->asset_id,
        ]);

        return redirect()->back()->with('success', 'Wallet created successfully!');
    }

    public function transfer(Request $request)
    {
        $request->validate([
            'wallet_id' => 'required|exists:user_wallets,id',
            'from_type' => 'required|string',
            'to_type' => 'required|string|different:from_type',
            'amount' => 'required|numeric|min:0.01'
        ]);

        $wallet = UserWallet::where('id', $request->wallet_id)
            ->where('user_id', Auth::user()->id)
            ->firstOrFail();

        $fromCol = $request->from_type . '_bal';
        $toCol = $request->to_type . '_bal';

        if ($wallet->$fromCol < $request->amount) {
            return response()->json(['status' => 'error', 'message' => 'Insufficient balance in source wallet.']);
        }

        $wallet->$fromCol -= $request->amount;
        $wallet->$toCol += $request->amount;
        $wallet->save();

        return response()->json(['status' => 'success', 'message' => 'Transfer completed successfully.']);
    }
}
