<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'symbol',
        'category',
        'type',
        'logo',
        'status',
        'base_rate',
        'price_source',
        'market_symbol',
        'previous_close',
        'change_24h',
        'high_24h',
        'low_24h',
        'volume_24h',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function tradingPairs()
    {
        return $this->hasMany(TradingPair::class, 'symbol', 'symbol');
    }

    public function quotedPairs()
    {
        return $this->hasMany(TradingPair::class, 'quote_asset', 'symbol');
    }
}
