<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradeSignal extends Model
{
    use HasFactory;

    protected $fillable = [
        'master_account_id',
        'external_trade_id',
        'trade_type',           // BUY, SELL
        'symbol',               // EURUSD, GBPUSD
        'volume',               // Lot size
        'open_price',
        'close_price',
        'stop_loss',
        'take_profit',
        'signal_timestamp',     // When master opened trade
        'closed_timestamp',     // When master closed trade
        'profit_loss',
        'status',               // NEW, REPLICATED, CLOSED
    ];

    protected $casts = [
        'signal_timestamp' => 'datetime',
        'closed_timestamp' => 'datetime',
        'volume' => 'decimal:2',
        'open_price' => 'decimal:8',
        'close_price' => 'decimal:8',
        'stop_loss' => 'decimal:8',
        'take_profit' => 'decimal:8',
        'profit_loss' => 'decimal:2',
    ];

    public function copyTrades()
    {
        return $this->hasMany(CopyTradeLog::class);
    }

    public function masterAccount()
    {
        return $this->belongsTo(MasterAccount::class, 'master_account_id');
    }
}
