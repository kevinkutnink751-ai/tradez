<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradingPair extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'symbol',
        'base_asset',
        'quote_asset',
        'instrument_category',
        'chart_symbol',
        'supported_markets',
        'leverage_options',
        'min_amount',
        'max_amount',
        'leverage',
        'status',
    ];

    protected $appends = [
        'display_name',
    ];

    protected $casts = [
        'supported_markets' => 'array',
        'leverage_options' => 'array',
        'status' => 'boolean',
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'symbol', 'symbol');
    }

    public function quoteAssetModel()
    {
        return $this->belongsTo(Asset::class, 'quote_asset', 'symbol');
    }

    public function getDisplayNameAttribute(): string
    {
        return $this->name ?: ($this->symbol . '/' . $this->quote_asset);
    }

    public function supportsMarket(string $market): bool
    {
        return in_array(strtolower($market), array_map('strtolower', $this->supported_markets ?? []), true);
    }

    public function availableLeverages(): array
    {
        $leverages = $this->leverage_options ?? [];

        if (empty($leverages) && !empty($this->leverage)) {
            $leverages = [(int) $this->leverage];
        }

        $leverages = array_values(array_unique(array_map('intval', $leverages)));
        sort($leverages);

        return $leverages;
    }

    public function getQuoteAssetAttribute($value): string
    {
        return $value ?: $this->attributes['base_asset'] ?? 'USD';
    }

    public function getLastPriceAttribute($value): float
    {
        if ($this->relationLoaded('asset') || $this->relationLoaded('quoteAssetModel')) {
            return $this->derivePairMetric('last_price', $value);
        }

        return (float) $this->derivePairMetric('last_price', $value);
    }

    public function getChange24hAttribute($value): float
    {
        return (float) $this->derivePairMetric('change_24h', $value);
    }

    public function getHigh24hAttribute($value): float
    {
        return (float) $this->derivePairMetric('high_24h', $value);
    }

    public function getLow24hAttribute($value): float
    {
        return (float) $this->derivePairMetric('low_24h', $value);
    }

    public function getVolume24hAttribute($value): float
    {
        return (float) $this->derivePairMetric('volume_24h', $value);
    }

    public function resolveChartSymbol(): string
    {
        if (!empty($this->chart_symbol)) {
            return $this->chart_symbol;
        }

        return 'FX:' . str_replace('/', '', $this->display_name);
    }

    protected function derivePairMetric(string $metric, $fallback): float
    {
        $asset = $this->relationLoaded('asset') ? $this->asset : $this->asset()->first();
        $quoteAsset = $this->relationLoaded('quoteAssetModel') ? $this->quoteAssetModel : $this->quoteAssetModel()->first();

        if (!$asset || !$quoteAsset) {
            return (float) ($fallback ?? 0);
        }

        $assetRate = (float) ($asset->base_rate ?? 0);
        $quoteRate = (float) ($quoteAsset->base_rate ?? 0);

        if ($assetRate <= 0 || $quoteRate <= 0) {
            return (float) ($fallback ?? 0);
        }

        if ($metric === 'last_price') {
            return round($assetRate / $quoteRate, 8);
        }

        if ($metric === 'volume_24h') {
            return (float) ($asset->volume_24h ?? $fallback ?? 0);
        }

        if ($metric === 'change_24h') {
            $assetPrev = (float) ($asset->previous_close ?? $assetRate);
            $quotePrev = (float) ($quoteAsset->previous_close ?? $quoteRate);

            if ($assetPrev <= 0 || $quotePrev <= 0) {
                return (float) ($fallback ?? 0);
            }

            $previousPairPrice = $assetPrev / $quotePrev;

            if ($previousPairPrice <= 0) {
                return (float) ($fallback ?? 0);
            }

            return round((($assetRate / $quoteRate) - $previousPairPrice) / $previousPairPrice * 100, 2);
        }

        $assetHigh = (float) ($asset->high_24h ?? $assetRate);
        $assetLow = (float) ($asset->low_24h ?? $assetRate);
        $quoteHigh = (float) ($quoteAsset->high_24h ?? $quoteRate);
        $quoteLow = (float) ($quoteAsset->low_24h ?? $quoteRate);

        if ($quoteHigh <= 0 || $quoteLow <= 0) {
            return (float) ($fallback ?? 0);
        }

        if ($metric === 'high_24h') {
            return round($assetHigh / $quoteLow, 8);
        }

        if ($metric === 'low_24h') {
            return round($assetLow / $quoteHigh, 8);
        }

        return (float) ($fallback ?? 0);
    }
}
