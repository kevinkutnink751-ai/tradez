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
            ['name' => 'United States Dollar', 'symbol' => 'USD', 'type' => 'Fiat', 'category' => 'Currency', 'base_rate' => 1, 'price_source' => null, 'market_symbol' => null, 'logo' => 'https://assets.coincap.io/assets/icons/usd@2x.png'],
            ['name' => 'Euro', 'symbol' => 'EUR', 'type' => 'Fiat', 'category' => 'Currency Futures', 'base_rate' => 1.08, 'price_source' => 'yahoo', 'market_symbol' => 'EURUSD=X', 'logo' => 'https://assets.coincap.io/assets/icons/eur@2x.png'],
            ['name' => 'British Pound', 'symbol' => 'GBP', 'type' => 'Fiat', 'category' => 'Currency Futures', 'base_rate' => 1.27, 'price_source' => 'yahoo', 'market_symbol' => 'GBPUSD=X', 'logo' => 'https://assets.coincap.io/assets/icons/gbp@2x.png'],
            ['name' => 'Japanese Yen', 'symbol' => 'JPY', 'type' => 'Fiat', 'category' => 'Currency Futures', 'base_rate' => 0.0067, 'price_source' => 'yahoo', 'market_symbol' => 'JPY=X', 'logo' => 'https://assets.coincap.io/assets/icons/jpy@2x.png'],
            ['name' => 'Australian Dollar', 'symbol' => 'AUD', 'type' => 'Fiat', 'category' => 'Currency Futures', 'base_rate' => 0.66, 'price_source' => 'yahoo', 'market_symbol' => 'AUDUSD=X', 'logo' => 'https://assets.coincap.io/assets/icons/aud@2x.png'],

            ['name' => 'Bitcoin', 'symbol' => 'BTC', 'type' => 'Crypto', 'category' => 'Cryptocurrency Futures', 'base_rate' => 65000, 'price_source' => 'binance', 'market_symbol' => 'BTCUSDT', 'logo' => 'https://assets.coincap.io/assets/icons/btc@2x.png'],
            ['name' => 'Ethereum', 'symbol' => 'ETH', 'type' => 'Crypto', 'category' => 'Cryptocurrency Futures', 'base_rate' => 3200, 'price_source' => 'binance', 'market_symbol' => 'ETHUSDT', 'logo' => 'https://assets.coincap.io/assets/icons/eth@2x.png'],
            ['name' => 'Solana', 'symbol' => 'SOL', 'type' => 'Crypto', 'category' => 'Cryptocurrency Futures', 'base_rate' => 140, 'price_source' => 'binance', 'market_symbol' => 'SOLUSDT', 'logo' => 'https://assets.coincap.io/assets/icons/sol@2x.png'],
            ['name' => 'XRP', 'symbol' => 'XRP', 'type' => 'Crypto', 'category' => 'Cryptocurrency Futures', 'base_rate' => 0.55, 'price_source' => 'binance', 'market_symbol' => 'XRPUSDT', 'logo' => 'https://assets.coincap.io/assets/icons/xrp@2x.png'],

            ['name' => 'Apple', 'symbol' => 'AAPL', 'type' => 'Equity', 'category' => 'Equities', 'base_rate' => 190, 'price_source' => 'yahoo', 'market_symbol' => 'AAPL', 'logo' => 'https://logo.clearbit.com/apple.com'],
            ['name' => 'Tesla', 'symbol' => 'TSLA', 'type' => 'Equity', 'category' => 'Equities', 'base_rate' => 175, 'price_source' => 'yahoo', 'market_symbol' => 'TSLA', 'logo' => 'https://logo.clearbit.com/tesla.com'],
            ['name' => 'NVIDIA', 'symbol' => 'NVDA', 'type' => 'Equity', 'category' => 'Equities', 'base_rate' => 900, 'price_source' => 'yahoo', 'market_symbol' => 'NVDA', 'logo' => 'https://logo.clearbit.com/nvidia.com'],

            ['name' => 'E-mini S&P 500', 'symbol' => 'ES', 'type' => 'Index', 'category' => 'Equity Index Futures', 'base_rate' => 5100, 'price_source' => 'yahoo', 'market_symbol' => 'ES=F', 'logo' => 'https://s3-symbol-logo.tradingview.com/indices/s-and-p-500--big.svg'],
            ['name' => 'E-mini Nasdaq 100', 'symbol' => 'NQ', 'type' => 'Index', 'category' => 'Equity Index Futures', 'base_rate' => 17800, 'price_source' => 'yahoo', 'market_symbol' => 'NQ=F', 'logo' => 'https://s3-symbol-logo.tradingview.com/indices/nasdaq-100--big.svg'],
            ['name' => 'E-mini Dow', 'symbol' => 'YM', 'type' => 'Index', 'category' => 'Equity Index Futures', 'base_rate' => 38600, 'price_source' => 'yahoo', 'market_symbol' => 'YM=F', 'logo' => 'https://s3-symbol-logo.tradingview.com/indices/us-30--big.svg'],
            ['name' => 'Russell 2000', 'symbol' => 'RTY', 'type' => 'Index', 'category' => 'Equity Index Futures', 'base_rate' => 2050, 'price_source' => 'yahoo', 'market_symbol' => 'RTY=F', 'logo' => 'https://s3-symbol-logo.tradingview.com/indices/us-2000-cash--big.svg'],

            ['name' => 'Gold', 'symbol' => 'GC', 'type' => 'Commodity', 'category' => 'Commodity Futures', 'base_rate' => 2300, 'price_source' => 'yahoo', 'market_symbol' => 'GC=F', 'logo' => 'https://s3-symbol-logo.tradingview.com/metal/gold--big.svg'],
            ['name' => 'Crude Oil', 'symbol' => 'CL', 'type' => 'Commodity', 'category' => 'Commodity Futures', 'base_rate' => 78, 'price_source' => 'yahoo', 'market_symbol' => 'CL=F', 'logo' => 'https://s3-symbol-logo.tradingview.com/energy/crude-oil--big.svg'],
            ['name' => 'Silver', 'symbol' => 'SI', 'type' => 'Commodity', 'category' => 'Commodity Futures', 'base_rate' => 27, 'price_source' => 'yahoo', 'market_symbol' => 'SI=F', 'logo' => 'https://s3-symbol-logo.tradingview.com/metal/silver--big.svg'],
            ['name' => 'Natural Gas', 'symbol' => 'NG', 'type' => 'Commodity', 'category' => 'Commodity Futures', 'base_rate' => 2.2, 'price_source' => 'yahoo', 'market_symbol' => 'NG=F', 'logo' => 'https://s3-symbol-logo.tradingview.com/energy/natural-gas--big.svg'],

            ['name' => '10-Year Treasury Note', 'symbol' => 'ZN', 'type' => 'Rate', 'category' => 'Interest Rate & Bond Futures', 'base_rate' => 110, 'price_source' => 'yahoo', 'market_symbol' => 'ZN=F', 'logo' => 'https://img.icons8.com/fluency/48/bonds.png'],
            ['name' => '30-Year Treasury Bond', 'symbol' => 'ZB', 'type' => 'Rate', 'category' => 'Interest Rate & Bond Futures', 'base_rate' => 118, 'price_source' => 'yahoo', 'market_symbol' => 'ZB=F', 'logo' => 'https://img.icons8.com/fluency/48/bonds.png'],

            ['name' => 'CBOE Volatility Index', 'symbol' => 'VX', 'type' => 'Volatility', 'category' => 'Volatility Futures', 'base_rate' => 15, 'price_source' => 'yahoo', 'market_symbol' => '^VIX', 'logo' => 'https://img.icons8.com/fluency/48/combo-chart.png'],
        ];

        foreach ($assets as $asset) {
            Asset::updateOrCreate(
                ['symbol' => $asset['symbol']],
                $asset + ['status' => true]
            );
        }
    }
}
