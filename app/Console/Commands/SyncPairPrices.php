<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TradingPair;
use Illuminate\Support\Facades\Http;

class SyncPairPrices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pairs:sync-prices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync real-time asset prices for trading pairs from public APIs (Binance for Crypto, Yahoo for Forex).';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting Real-Time Price Sync...');

        $pairs = TradingPair::where('status', true)->get();
        if ($pairs->isEmpty()) {
            $this->info('No active trading pairs found.');
            return;
        }

        // Fetch Binance Data (Bulk for all crypto pairs)
        $this->info('Fetching Binance 24h Ticker data...');
        $binanceData = [];
        try {
            $response = Http::timeout(15)->get('https://api.binance.com/api/v3/ticker/24hr');
            if ($response->successful()) {
                $binanceData = collect($response->json())->keyBy('symbol')->toArray();
            }
        } catch (\Exception $e) {
            $this->error('Failed to fetch Binance data: ' . $e->getMessage());
        }

        foreach ($pairs as $pair) {
            $symbolStr = str_replace('/', '', $pair->name); // e.g., BTC/USDT -> BTCUSDT
            
            // Check if it's likely a Crypto pair (base ends with USDT, BTC, ETH, BUSD)
            $isCrypto = str_ends_with($symbolStr, 'USDT') || str_ends_with($symbolStr, 'BTC') || str_ends_with($symbolStr, 'ETH');
            if ($isCrypto && isset($binanceData[$symbolStr])) {
                $data = $binanceData[$symbolStr];
               
                $pair->update([
                    'last_price' => $data['lastPrice'],
                    'change_24h' => $data['priceChangePercent'],
                    'high_24h' => $data['highPrice'],
                    'low_24h' => $data['lowPrice'],
                    'volume_24h' => $data['volume'],
                ]);
                $this->info("Updated {$pair->name} from Binance.");
            } else {
                // Fallback to Yahoo Finance for Forex / Stocks / Metals (e.g. EURUSD=X, GC=F)
                $yahooSymbol = $symbolStr;
                if (!str_contains($symbolStr, '=')) {
                    // Typical forex pairs like EURUSD -> EURUSD=X
                    $yahooSymbol = $symbolStr . '=X';
                }
                
                try {
                    $yResponse = Http::timeout(10)->get("https://query1.finance.yahoo.com/v8/finance/chart/{$yahooSymbol}?range=1d&interval=1d");
                    if ($yResponse->successful()) {
                        $json = $yResponse->json();
                        $result = $json['chart']['result'][0] ?? null;
                        
                        if ($result) {
                            $meta = $result['meta'];
                            $indicators = $result['indicators']['quote'][0] ?? null;
                            
                            if ($indicators) {
                                $lastPrice = $meta['regularMarketPrice'] ?? 0;
                                $prevClose = $meta['chartPreviousClose'] ?? $lastPrice;
                                
                                $change = 0;
                                if ($prevClose > 0) {
                                    $change = (($lastPrice - $prevClose) / $prevClose) * 100;
                                }
                                
                                // high and low arrays might be empty or null
                                $highArr = $indicators['high'] ?? [];
                                $lowArr = $indicators['low'] ?? [];
                                $volArr = $indicators['volume'] ?? [];
                                
                                $high = !empty($highArr) ? max(array_filter($highArr)) : $lastPrice;
                                $low = !empty($lowArr) ? min(array_filter($lowArr)) : $lastPrice;
                                $volume = !empty($volArr) ? end($volArr) : 0;
                                
                                $pair->update([
                                    'last_price' => $lastPrice,
                                    'change_24h' => round($change, 2),
                                    'high_24h' => $high,
                                    'low_24h' => $low,
                                    'volume_24h' => $volume,
                                ]);
                                $this->info("Updated {$pair->name} from Yahoo Finance.");
                            }
                        } else {
                            $this->warn("No data found on Yahoo Finance for {$pair->name} ({$yahooSymbol})");
                        }
                    }
                } catch (\Exception $e) {
                    $this->error("Failed to fetch Yahoo data for {$pair->name}: " . $e->getMessage());
                }
            }
        }

        $this->info('Real-Time Price Sync Complete.');
    }
}
