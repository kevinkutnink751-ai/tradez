<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserWallet;
use App\Models\Asset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
            'availableAssets' => $availableAssets,
            'balanceTypes' => [
                'spot' => 'Spot',
                'funding' => 'Funding',
                'future' => 'Futures',
                'copy_trade' => 'Copy Trade',
            ],
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
            'from_wallet_id' => 'required|exists:user_wallets,id',
            'to_wallet_id' => 'required|exists:user_wallets,id',
            'from_type' => ['required', Rule::in(['spot', 'funding', 'future', 'copy_trade'])],
            'to_type' => ['required', Rule::in(['spot', 'funding', 'future', 'copy_trade'])],
            'amount' => 'required|numeric|min:0.00000001'
        ]);

        $fromWallet = UserWallet::with('asset')->where('id', $request->from_wallet_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        $toWallet = UserWallet::with('asset')->where('id', $request->to_wallet_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $fromCol = $request->from_type . '_bal';
        $toCol = $request->to_type . '_bal';

        // Check if we are transferring from/to the same asset segment in the same wallet
        if ($request->from_wallet_id == $request->to_wallet_id && $request->from_type == $request->to_type) {
            return response()->json(['status' => 'error', 'message' => 'Source and destination cannot be identical.']);
        }

        if ($fromWallet->$fromCol < $request->amount) {
            return response()->json(['status' => 'error', 'message' => 'Insufficient balance in source account.']);
        }

        // Logic fix: If transferring same asset between sub-wallets, no conversion needed
        if ($fromWallet->asset_id === $toWallet->asset_id) {
            $convertedAmount = $request->amount;
        } else {
            // Conversion logic if moving between different assets
            $fromRate = (float) ($fromWallet->asset->base_rate ?: 0);
            $toRate = (float) ($toWallet->asset->base_rate ?: 0);

            if ($fromRate <= 0 || $toRate <= 0) {
                return response()->json(['status' => 'error', 'message' => 'Unable to price one of the selected assets.']);
            }

            $usdValue = $request->amount * $fromRate;
            $convertedAmount = $usdValue / $toRate;
        }

        // Atomic update if same wallet record
        if ($fromWallet->id === $toWallet->id) {
            $fromWallet->$fromCol -= $request->amount;
            $fromWallet->$toCol += $convertedAmount;
            $fromWallet->save();
        } else {
            $fromWallet->$fromCol -= $request->amount;
            $toWallet->$toCol += $convertedAmount;
            $fromWallet->save();
            $toWallet->save();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Transfer completed successfully.',
            'converted_amount' => round($convertedAmount, 8),
            'target_symbol' => $toWallet->asset->symbol,
        ]);
    }
}
