<?php

namespace Database\Seeders;

use App\Models\TradingPair;
use Illuminate\Database\Seeder;

class TradingPairsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pairs = [
            // Crypto Pairs - Spot
            ['name' => 'BTC/USDT', 'symbol' => 'BTC', 'base_asset' => 'USDT', 'type' => 'Spot', 'leverage' => 1],
            ['name' => 'ETH/USDT', 'symbol' => 'ETH', 'base_asset' => 'USDT', 'type' => 'Spot', 'leverage' => 1],
            ['name' => 'SOL/USDT', 'symbol' => 'SOL', 'base_asset' => 'USDT', 'type' => 'Spot', 'leverage' => 1],
            ['name' => 'BNB/USDT', 'symbol' => 'BNB', 'base_asset' => 'USDT', 'type' => 'Spot', 'leverage' => 1],

            // Crypto Pairs - Future
            ['name' => 'BTC/USDT', 'symbol' => 'BTC', 'base_asset' => 'USDT', 'type' => 'Future', 'leverage' => 125],
            ['name' => 'ETH/USDT', 'symbol' => 'ETH', 'base_asset' => 'USDT', 'type' => 'Future', 'leverage' => 100],
            ['name' => 'SOL/USDT', 'symbol' => 'SOL', 'base_asset' => 'USDT', 'type' => 'Future', 'leverage' => 50],
            ['name' => 'XRP/USDT', 'symbol' => 'XRP', 'base_asset' => 'USDT', 'type' => 'Future', 'leverage' => 50],

            // Forex Pairs - Future
            ['name' => 'EUR/USD', 'symbol' => 'EUR', 'base_asset' => 'USD', 'type' => 'Future', 'leverage' => 500],
            ['name' => 'GBP/USD', 'symbol' => 'GBP', 'base_asset' => 'USD', 'type' => 'Future', 'leverage' => 500],
            ['name' => 'USD/JPY', 'symbol' => 'JPY', 'base_asset' => 'USD', 'type' => 'Future', 'leverage' => 500],
            ['name' => 'AUD/USD', 'symbol' => 'AUD', 'base_asset' => 'USD', 'type' => 'Future', 'leverage' => 500],

            // Binary Pairs
            ['name' => 'BTC/USDT', 'symbol' => 'BTC', 'base_asset' => 'USDT', 'type' => 'Binary', 'leverage' => 1],
            ['name' => 'ETH/USDT', 'symbol' => 'ETH', 'base_asset' => 'USDT', 'type' => 'Binary', 'leverage' => 1],
            ['name' => 'EUR/USD', 'symbol' => 'EUR', 'base_asset' => 'USD', 'type' => 'Binary', 'leverage' => 1],

            // Option Pairs
            ['name' => 'BTC/USDT', 'symbol' => 'BTC', 'base_asset' => 'USDT', 'type' => 'Option', 'leverage' => 1],
            ['name' => 'ETH/USDT', 'symbol' => 'ETH', 'base_asset' => 'USDT', 'type' => 'Option', 'leverage' => 1],
        ];

        foreach ($pairs as $pair) {
            TradingPair::updateOrCreate(
                ['name' => $pair['name'], 'type' => $pair['type']],
                [
                    'symbol' => $pair['symbol'],
                    'base_asset' => $pair['base_asset'],
                    'min_amount' => 10,
                    'max_amount' => 1000000,
                    'leverage' => $pair['leverage'],
                    'status' => true,
                ]
            );
        }
    }
}
