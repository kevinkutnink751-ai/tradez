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
            ['name' => 'BTC/USD', 'symbol' => 'BTC', 'quote_asset' => 'USD', 'instrument_category' => 'Cryptocurrency Futures', 'supported_markets' => ['spot', 'future', 'binary', 'option'], 'leverage_options' => [1, 5, 10, 25, 50, 75, 100, 125], 'chart_symbol' => 'BINANCE:BTCUSDT'],
            ['name' => 'ETH/USD', 'symbol' => 'ETH', 'quote_asset' => 'USD', 'instrument_category' => 'Cryptocurrency Futures', 'supported_markets' => ['spot', 'future', 'option'], 'leverage_options' => [1, 5, 10, 25, 50, 75, 100], 'chart_symbol' => 'BINANCE:ETHUSDT'],
            ['name' => 'SOL/USD', 'symbol' => 'SOL', 'quote_asset' => 'USD', 'instrument_category' => 'Cryptocurrency Futures', 'supported_markets' => ['spot', 'future'], 'leverage_options' => [1, 5, 10, 20, 50], 'chart_symbol' => 'BINANCE:SOLUSDT'],
            ['name' => 'AAPL/USD', 'symbol' => 'AAPL', 'quote_asset' => 'USD', 'instrument_category' => 'Equities', 'supported_markets' => ['spot', 'binary', 'option'], 'leverage_options' => [1, 2, 3, 5], 'chart_symbol' => 'NASDAQ:AAPL'],
            ['name' => 'TSLA/USD', 'symbol' => 'TSLA', 'quote_asset' => 'USD', 'instrument_category' => 'Equities', 'supported_markets' => ['spot', 'option'], 'leverage_options' => [1, 2, 3, 5], 'chart_symbol' => 'NASDAQ:TSLA'],
            ['name' => 'NVDA/USD', 'symbol' => 'NVDA', 'quote_asset' => 'USD', 'instrument_category' => 'Equities', 'supported_markets' => ['spot', 'future'], 'leverage_options' => [1, 2, 3, 5, 10], 'chart_symbol' => 'NASDAQ:NVDA'],
            ['name' => 'EUR/USD', 'symbol' => 'EUR', 'quote_asset' => 'USD', 'instrument_category' => 'Currency Futures', 'supported_markets' => ['spot', 'future', 'binary'], 'leverage_options' => [1, 10, 25, 50, 100, 200], 'chart_symbol' => 'OANDA:EURUSD'],
            ['name' => 'GBP/USD', 'symbol' => 'GBP', 'quote_asset' => 'USD', 'instrument_category' => 'Currency Futures', 'supported_markets' => ['future'], 'leverage_options' => [1, 10, 25, 50, 100, 200], 'chart_symbol' => 'OANDA:GBPUSD'],
            ['name' => 'USD/JPY', 'symbol' => 'USD', 'quote_asset' => 'JPY', 'instrument_category' => 'Currency Futures', 'supported_markets' => ['future'], 'leverage_options' => [1, 10, 25, 50, 100, 200], 'chart_symbol' => 'OANDA:USDJPY'],
            ['name' => 'ES/USD', 'symbol' => 'ES', 'quote_asset' => 'USD', 'instrument_category' => 'Equity Index Futures', 'supported_markets' => ['future'], 'leverage_options' => [1, 5, 10, 20, 50, 100], 'chart_symbol' => 'CME_MINI:ES1!'],
            ['name' => 'NQ/USD', 'symbol' => 'NQ', 'quote_asset' => 'USD', 'instrument_category' => 'Equity Index Futures', 'supported_markets' => ['future'], 'leverage_options' => [1, 5, 10, 20, 50, 100], 'chart_symbol' => 'CME_MINI:NQ1!'],
            ['name' => 'YM/USD', 'symbol' => 'YM', 'quote_asset' => 'USD', 'instrument_category' => 'Equity Index Futures', 'supported_markets' => ['future'], 'leverage_options' => [1, 5, 10, 20, 50, 100], 'chart_symbol' => 'CBOT_MINI:YM1!'],
            ['name' => 'GC/USD', 'symbol' => 'GC', 'quote_asset' => 'USD', 'instrument_category' => 'Commodity Futures', 'supported_markets' => ['future'], 'leverage_options' => [1, 5, 10, 25, 50, 75], 'chart_symbol' => 'COMEX:GC1!'],
            ['name' => 'CL/USD', 'symbol' => 'CL', 'quote_asset' => 'USD', 'instrument_category' => 'Commodity Futures', 'supported_markets' => ['future'], 'leverage_options' => [1, 5, 10, 25, 50, 75], 'chart_symbol' => 'NYMEX:CL1!'],
            ['name' => 'ZN/USD', 'symbol' => 'ZN', 'quote_asset' => 'USD', 'instrument_category' => 'Interest Rate & Bond Futures', 'supported_markets' => ['future'], 'leverage_options' => [1, 2, 5, 10, 25, 50], 'chart_symbol' => 'CBOT:ZN1!'],
            ['name' => 'ZB/USD', 'symbol' => 'ZB', 'quote_asset' => 'USD', 'instrument_category' => 'Interest Rate & Bond Futures', 'supported_markets' => ['future'], 'leverage_options' => [1, 2, 5, 10, 25, 50], 'chart_symbol' => 'CBOT:ZB1!'],
            ['name' => 'VX/USD', 'symbol' => 'VX', 'quote_asset' => 'USD', 'instrument_category' => 'Volatility Futures', 'supported_markets' => ['future'], 'leverage_options' => [1, 2, 5, 10, 20], 'chart_symbol' => 'CBOE:VIX'],
        ];

        foreach ($pairs as $pair) {
            $record = TradingPair::updateOrCreate(
                ['name' => $pair['name']],
                [
                    'symbol' => $pair['symbol'],
                    'base_asset' => $pair['quote_asset'],
                    'quote_asset' => $pair['quote_asset'],
                    'instrument_category' => $pair['instrument_category'],
                    'chart_symbol' => $pair['chart_symbol'],
                    'supported_markets' => $pair['supported_markets'],
                    'leverage_options' => $pair['leverage_options'],
                    'min_amount' => 10,
                    'max_amount' => 1000000,
                    'leverage' => max($pair['leverage_options']),
                    'status' => true,
                ]
            );

            TradingPair::where('name', $pair['name'])->where('id', '<>', $record->id)->delete();
        }
    }
}
