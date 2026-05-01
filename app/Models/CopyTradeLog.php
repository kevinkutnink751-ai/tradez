<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CopyTradeLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'trade_signal_id',
        'subscriber_account_id',
        'executed_volume',
        'executed_price',
        'executed_trade_id',
        'closed_price',
        'profit_loss',
        'status',               // SUCCESS, FAILED, CLOSED
        'error_message',
        'copied_at',
        'closed_at',
    ];

    protected $casts = [
        'copied_at' => 'datetime',
        'closed_at' => 'datetime',
        'executed_volume' => 'decimal:2',
        'executed_price' => 'decimal:8',
        'closed_price' => 'decimal:8',
        'profit_loss' => 'decimal:2',
    ];

    public function signal()
    {
        return $this->belongsTo(TradeSignal::class, 'trade_signal_id');
    }

    public function subscriber()
    {
        return $this->belongsTo(Mt4Details::class, 'subscriber_account_id');
    }
}
