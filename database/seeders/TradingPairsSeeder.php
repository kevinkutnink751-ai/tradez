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
            ['name' => 'BTC/USD', 'symbol' => 'BTC', 'quote_asset' => 'USD', 'type' => 'Spot', 'instrument_category' => 'Cryptocurrency', 'leverage' => 1, 'chart_symbol' => 'BINANCE:BTCUSDT'],
            ['name' => 'ETH/USD', 'symbol' => 'ETH', 'quote_asset' => 'USD', 'type' => 'Spot', 'instrument_category' => 'Cryptocurrency', 'leverage' => 1, 'chart_symbol' => 'BINANCE:ETHUSDT'],
            ['name' => 'SOL/USD', 'symbol' => 'SOL', 'quote_asset' => 'USD', 'type' => 'Spot', 'instrument_category' => 'Cryptocurrency', 'leverage' => 1, 'chart_symbol' => 'BINANCE:SOLUSDT'],
            ['name' => 'AAPL/USD', 'symbol' => 'AAPL', 'quote_asset' => 'USD', 'type' => 'Spot', 'instrument_category' => 'Equities', 'leverage' => 1, 'chart_symbol' => 'NASDAQ:AAPL'],
            ['name' => 'EUR/USD', 'symbol' => 'EUR', 'quote_asset' => 'USD', 'type' => 'Spot', 'instrument_category' => 'Forex', 'leverage' => 1, 'chart_symbol' => 'FX:EURUSD'],

            ['name' => 'ES/USD', 'symbol' => 'ES', 'quote_asset' => 'USD', 'type' => 'Future', 'instrument_category' => 'Equity Index Futures', 'leverage' => 100, 'chart_symbol' => 'CME_MINI:ES1!'],
            ['name' => 'NQ/USD', 'symbol' => 'NQ', 'quote_asset' => 'USD', 'type' => 'Future', 'instrument_category' => 'Equity Index Futures', 'leverage' => 100, 'chart_symbol' => 'CME_MINI:NQ1!'],
            ['name' => 'YM/USD', 'symbol' => 'YM', 'quote_asset' => 'USD', 'type' => 'Future', 'instrument_category' => 'Equity Index Futures', 'leverage' => 100, 'chart_symbol' => 'CBOT_MINI:YM1!'],
            ['name' => 'GC/USD', 'symbol' => 'GC', 'quote_asset' => 'USD', 'type' => 'Future', 'instrument_category' => 'Commodity Futures', 'leverage' => 75, 'chart_symbol' => 'COMEX:GC1!'],
            ['name' => 'CL/USD', 'symbol' => 'CL', 'quote_asset' => 'USD', 'type' => 'Future', 'instrument_category' => 'Commodity Futures', 'leverage' => 75, 'chart_symbol' => 'NYMEX:CL1!'],
            ['name' => 'EUR/USD', 'symbol' => 'EUR', 'quote_asset' => 'USD', 'type' => 'Future', 'instrument_category' => 'Currency Futures', 'leverage' => 200, 'chart_symbol' => 'FX:EURUSD'],
            ['name' => 'GBP/USD', 'symbol' => 'GBP', 'quote_asset' => 'USD', 'type' => 'Future', 'instrument_category' => 'Currency Futures', 'leverage' => 200, 'chart_symbol' => 'FX:GBPUSD'],
            ['name' => 'USD/JPY', 'symbol' => 'USD', 'quote_asset' => 'JPY', 'type' => 'Future', 'instrument_category' => 'Currency Futures', 'leverage' => 200, 'chart_symbol' => 'FX:USDJPY'],
            ['name' => 'ZN/USD', 'symbol' => 'ZN', 'quote_asset' => 'USD', 'type' => 'Future', 'instrument_category' => 'Interest Rate & Bond Futures', 'leverage' => 50, 'chart_symbol' => 'CBOT:ZN1!'],
            ['name' => 'ZB/USD', 'symbol' => 'ZB', 'quote_asset' => 'USD', 'type' => 'Future', 'instrument_category' => 'Interest Rate & Bond Futures', 'leverage' => 50, 'chart_symbol' => 'CBOT:ZB1!'],
            ['name' => 'BTC/USD', 'symbol' => 'BTC', 'quote_asset' => 'USD', 'type' => 'Future', 'instrument_category' => 'Cryptocurrency Futures', 'leverage' => 125, 'chart_symbol' => 'BINANCE:BTCUSDT.P'],
            ['name' => 'ETH/USD', 'symbol' => 'ETH', 'quote_asset' => 'USD', 'type' => 'Future', 'instrument_category' => 'Cryptocurrency Futures', 'leverage' => 100, 'chart_symbol' => 'BINANCE:ETHUSDT.P'],
            ['name' => 'VX/USD', 'symbol' => 'VX', 'quote_asset' => 'USD', 'type' => 'Future', 'instrument_category' => 'Volatility Futures', 'leverage' => 20, 'chart_symbol' => 'CBOE:VIX'],

            ['name' => 'BTC/USD', 'symbol' => 'BTC', 'quote_asset' => 'USD', 'type' => 'Binary', 'instrument_category' => 'Cryptocurrency', 'leverage' => 1, 'chart_symbol' => 'BINANCE:BTCUSDT'],
            ['name' => 'EUR/USD', 'symbol' => 'EUR', 'quote_asset' => 'USD', 'type' => 'Binary', 'instrument_category' => 'Forex', 'leverage' => 1, 'chart_symbol' => 'FX:EURUSD'],
            ['name' => 'AAPL/USD', 'symbol' => 'AAPL', 'quote_asset' => 'USD', 'type' => 'Binary', 'instrument_category' => 'Equities', 'leverage' => 1, 'chart_symbol' => 'NASDAQ:AAPL'],

            ['name' => 'BTC/USD', 'symbol' => 'BTC', 'quote_asset' => 'USD', 'type' => 'Option', 'instrument_category' => 'Cryptocurrency', 'leverage' => 1, 'chart_symbol' => 'BINANCE:BTCUSDT'],
            ['name' => 'ETH/USD', 'symbol' => 'ETH', 'quote_asset' => 'USD', 'type' => 'Option', 'instrument_category' => 'Cryptocurrency', 'leverage' => 1, 'chart_symbol' => 'BINANCE:ETHUSDT'],
            ['name' => 'AAPL/USD', 'symbol' => 'AAPL', 'quote_asset' => 'USD', 'type' => 'Option', 'instrument_category' => 'Equities', 'leverage' => 1, 'chart_symbol' => 'NASDAQ:AAPL'],
        ];

        foreach ($pairs as $pair) {
            TradingPair::updateOrCreate(
                ['name' => $pair['name'], 'type' => $pair['type']],
                [
                    'symbol' => $pair['symbol'],
                    'base_asset' => $pair['quote_asset'],
                    'quote_asset' => $pair['quote_asset'],
                    'instrument_category' => $pair['instrument_category'],
                    'chart_symbol' => $pair['chart_symbol'],
                    'min_amount' => 10,
                    'max_amount' => 1000000,
                    'leverage' => $pair['leverage'],
                    'status' => true,
                ]
            );
        }
    }
}
