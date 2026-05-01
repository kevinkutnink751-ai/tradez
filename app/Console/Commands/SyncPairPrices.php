<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Asset;
use Illuminate\Support\Facades\Http;

class SyncPairPrices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assets:sync-prices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync real-time asset prices from public APIs so trading pairs can derive their prices from underlying assets.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting asset price sync...');

        $assets = Asset::where('status', true)->get();
        if ($assets->isEmpty()) {
            $this->info('No active assets found.');
            return;
        }

        $this->info('Fetching Binance 24h ticker data...');
        $binanceData = [];
        try {
            $response = Http::timeout(15)->get('https://api.binance.com/api/v3/ticker/24hr');
            if ($response->successful()) {
                $binanceData = collect($response->json())->keyBy('symbol')->toArray();
            }
        } catch (\Exception $e) {
            $this->error('Failed to fetch Binance data: ' . $e->getMessage());
        }

        foreach ($assets as $asset) {
            if (!$asset->market_symbol || !$asset->price_source) {
                if ($asset->symbol === 'USD') {
                    $asset->update([
                        'base_rate' => 1,
                        'previous_close' => 1,
                        'high_24h' => 1,
                        'low_24h' => 1,
                        'change_24h' => 0,
                        'volume_24h' => 0,
                    ]);
                }
                continue;
            }

            if ($asset->price_source === 'binance' && isset($binanceData[$asset->market_symbol])) {
                $data = $binanceData[$asset->market_symbol];
                $lastPrice = (float) ($data['lastPrice'] ?? 0);
                $change = (float) ($data['priceChangePercent'] ?? 0);
                $previousClose = $lastPrice / (1 + ($change / 100));

                $asset->update([
                    'base_rate' => $lastPrice,
                    'previous_close' => $previousClose,
                    'change_24h' => $change,
                    'high_24h' => $data['highPrice'] ?? $lastPrice,
                    'low_24h' => $data['lowPrice'] ?? $lastPrice,
                    'volume_24h' => $data['volume'] ?? 0,
                ]);
                $this->info("Updated {$asset->symbol} from Binance.");
                continue;
            }

            if ($asset->price_source !== 'yahoo') {
                continue;
            }

            try {
                $response = Http::timeout(10)->get("https://query1.finance.yahoo.com/v8/finance/chart/{$asset->market_symbol}?range=1d&interval=1d");
                if (!$response->successful()) {
                    $this->warn("Yahoo request failed for {$asset->symbol}.");
                    continue;
                }

                $json = $response->json();
                $result = $json['chart']['result'][0] ?? null;

                if (!$result) {
                    $this->warn("No Yahoo data found for {$asset->symbol} ({$asset->market_symbol})");
                    continue;
                }

                $meta = $result['meta'] ?? [];
                $indicators = $result['indicators']['quote'][0] ?? [];
                $lastPrice = (float) ($meta['regularMarketPrice'] ?? 0);
                $previousClose = (float) ($meta['chartPreviousClose'] ?? $lastPrice);

                if ($lastPrice <= 0) {
                    $this->warn("Invalid Yahoo price returned for {$asset->symbol}.");
                    continue;
                }

                $change = $previousClose > 0
                    ? (($lastPrice - $previousClose) / $previousClose) * 100
                    : 0;

                $highValues = array_filter($indicators['high'] ?? [], fn ($value) => $value !== null);
                $lowValues = array_filter($indicators['low'] ?? [], fn ($value) => $value !== null);
                $volumeValues = array_filter($indicators['volume'] ?? [], fn ($value) => $value !== null);

                $asset->update([
                    'base_rate' => $lastPrice,
                    'previous_close' => $previousClose,
                    'change_24h' => round($change, 2),
                    'high_24h' => !empty($highValues) ? max($highValues) : $lastPrice,
                    'low_24h' => !empty($lowValues) ? min($lowValues) : $lastPrice,
                    'volume_24h' => !empty($volumeValues) ? end($volumeValues) : 0,
                ]);
                $this->info("Updated {$asset->symbol} from Yahoo Finance.");
            } catch (\Exception $e) {
                $this->error("Failed to fetch Yahoo data for {$asset->symbol}: " . $e->getMessage());
            }
        }

        $this->info('Asset price sync complete.');
    }
}
