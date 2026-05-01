<?php

namespace App\Traits;

use App\Models\Asset;
use App\Models\UserWallet;
use Illuminate\Support\Facades\Session;

trait UserWalletTrait
{
    protected function creditDepositWallet(int $userId, float $amount, ?int $assetId = null, ?string $balanceType = null): void
    {
        $assetId = $assetId ?: session()->get('deposit_asset_id', $this->resolveUsdAsset()->id);
        $balanceType = $balanceType ?: session()->get('deposit_balance_type', 'funding');

        $wallet = UserWallet::firstOrCreate([
            'user_id' => $userId,
            'asset_id' => $assetId,
        ]);

        $column = strtolower($balanceType) . '_bal';
        if (!in_array($column, ['spot_bal', 'future_bal', 'funding_bal', 'copy_trade_bal'])) {
            $column = 'funding_bal';
        }

        $wallet->$column += $amount;
        $wallet->save();
    }

    protected function resolveUsdAsset(): Asset
    {
        return Asset::firstOrCreate(
            ['symbol' => 'USD'],
            [
                'name' => 'US Dollar',
                'type' => 'Fiat',
                'category' => 'Currency',
                'status' => true,
                'base_rate' => 1,
                'previous_close' => 1,
                'high_24h' => 1,
                'low_24h' => 1,
                'change_24h' => 0,
            ]
        );
    }
}
