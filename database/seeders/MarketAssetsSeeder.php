<?php

namespace Database\Seeders;

use App\Models\Asset;
use Illuminate\Database\Seeder;

class MarketAssetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $assets = [
            ['name' => 'United States Dollar', 'symbol' => 'USD', 'type' => 'Fiat', 'category' => 'Currency', 'base_rate' => 1, 'price_source' => null, 'market_symbol' => null],
            ['name' => 'Euro', 'symbol' => 'EUR', 'type' => 'Fiat', 'category' => 'Currency Futures', 'base_rate' => 1.08, 'price_source' => 'yahoo', 'market_symbol' => 'EURUSD=X'],
            ['name' => 'British Pound', 'symbol' => 'GBP', 'type' => 'Fiat', 'category' => 'Currency Futures', 'base_rate' => 1.27, 'price_source' => 'yahoo', 'market_symbol' => 'GBPUSD=X'],
            ['name' => 'Japanese Yen', 'symbol' => 'JPY', 'type' => 'Fiat', 'category' => 'Currency Futures', 'base_rate' => 0.0067, 'price_source' => null, 'market_symbol' => null],
            ['name' => 'Australian Dollar', 'symbol' => 'AUD', 'type' => 'Fiat', 'category' => 'Currency Futures', 'base_rate' => 0.66, 'price_source' => 'yahoo', 'market_symbol' => 'AUDUSD=X'],

            ['name' => 'Bitcoin', 'symbol' => 'BTC', 'type' => 'Crypto', 'category' => 'Cryptocurrency Futures', 'base_rate' => 65000, 'price_source' => 'binance', 'market_symbol' => 'BTCUSDT'],
            ['name' => 'Ethereum', 'symbol' => 'ETH', 'type' => 'Crypto', 'category' => 'Cryptocurrency Futures', 'base_rate' => 3200, 'price_source' => 'binance', 'market_symbol' => 'ETHUSDT'],
            ['name' => 'Solana', 'symbol' => 'SOL', 'type' => 'Crypto', 'category' => 'Cryptocurrency Futures', 'base_rate' => 140, 'price_source' => 'binance', 'market_symbol' => 'SOLUSDT'],
            ['name' => 'XRP', 'symbol' => 'XRP', 'type' => 'Crypto', 'category' => 'Cryptocurrency Futures', 'base_rate' => 0.55, 'price_source' => 'binance', 'market_symbol' => 'XRPUSDT'],

            ['name' => 'Apple', 'symbol' => 'AAPL', 'type' => 'Equity', 'category' => 'Equities', 'base_rate' => 190, 'price_source' => 'yahoo', 'market_symbol' => 'AAPL'],
            ['name' => 'Tesla', 'symbol' => 'TSLA', 'type' => 'Equity', 'category' => 'Equities', 'base_rate' => 175, 'price_source' => 'yahoo', 'market_symbol' => 'TSLA'],

            ['name' => 'E-mini S&P 500', 'symbol' => 'ES', 'type' => 'Index', 'category' => 'Equity Index Futures', 'base_rate' => 5100, 'price_source' => 'yahoo', 'market_symbol' => 'ES=F'],
            ['name' => 'E-mini Nasdaq 100', 'symbol' => 'NQ', 'type' => 'Index', 'category' => 'Equity Index Futures', 'base_rate' => 17800, 'price_source' => 'yahoo', 'market_symbol' => 'NQ=F'],
            ['name' => 'E-mini Dow', 'symbol' => 'YM', 'type' => 'Index', 'category' => 'Equity Index Futures', 'base_rate' => 38600, 'price_source' => 'yahoo', 'market_symbol' => 'YM=F'],
            ['name' => 'Russell 2000', 'symbol' => 'RTY', 'type' => 'Index', 'category' => 'Equity Index Futures', 'base_rate' => 2050, 'price_source' => 'yahoo', 'market_symbol' => 'RTY=F'],

            ['name' => 'Gold', 'symbol' => 'GC', 'type' => 'Commodity', 'category' => 'Commodity Futures', 'base_rate' => 2300, 'price_source' => 'yahoo', 'market_symbol' => 'GC=F'],
            ['name' => 'Crude Oil', 'symbol' => 'CL', 'type' => 'Commodity', 'category' => 'Commodity Futures', 'base_rate' => 78, 'price_source' => 'yahoo', 'market_symbol' => 'CL=F'],
            ['name' => 'Silver', 'symbol' => 'SI', 'type' => 'Commodity', 'category' => 'Commodity Futures', 'base_rate' => 27, 'price_source' => 'yahoo', 'market_symbol' => 'SI=F'],
            ['name' => 'Natural Gas', 'symbol' => 'NG', 'type' => 'Commodity', 'category' => 'Commodity Futures', 'base_rate' => 2.2, 'price_source' => 'yahoo', 'market_symbol' => 'NG=F'],

            ['name' => '10-Year Treasury Note', 'symbol' => 'ZN', 'type' => 'Rate', 'category' => 'Interest Rate & Bond Futures', 'base_rate' => 110, 'price_source' => 'yahoo', 'market_symbol' => 'ZN=F'],
            ['name' => '30-Year Treasury Bond', 'symbol' => 'ZB', 'type' => 'Rate', 'category' => 'Interest Rate & Bond Futures', 'base_rate' => 118, 'price_source' => 'yahoo', 'market_symbol' => 'ZB=F'],

            ['name' => 'CBOE Volatility Index', 'symbol' => 'VX', 'type' => 'Volatility', 'category' => 'Volatility Futures', 'base_rate' => 15, 'price_source' => 'yahoo', 'market_symbol' => '^VIX'],
        ];

        foreach ($assets as $asset) {
            Asset::updateOrCreate(
                ['symbol' => $asset['symbol']],
                $asset + ['status' => true]
            );
        }
    }
}
