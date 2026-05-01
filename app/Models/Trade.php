<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'trading_pair_id',
        'pair',
        'asset_symbol',
        'quote_asset_symbol',
        'settlement_asset',
        'type',
        'market_type',
        'order_type',
        'instrument_category',
        'amount',
        'price',
        'leverage',
        'status',
        'pnl',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tradingPair()
    {
        return $this->belongsTo(TradingPair::class);
    }
}
