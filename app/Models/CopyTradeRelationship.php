<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CopyTradeRelationship extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscriber_account_id',
        'master_account_id',
        'status',               // ACTIVE, DISABLED, PAUSED
        'risk_settings',        // JSON: sizing_strategy, max_position, daily_loss_limit
        'enabled_at',
        'disabled_at',
        'total_trades_copied',
        'successful_copies',
        'failed_copies',
        'total_profit_loss',
        'last_trade_copied_at',
    ];

    protected $casts = [
        'risk_settings' => 'json',
        'enabled_at' => 'datetime',
        'disabled_at' => 'datetime',
        'last_trade_copied_at' => 'datetime',
        'total_profit_loss' => 'decimal:2',
    ];

    public function subscriber()
    {
        return $this->belongsTo(Mt4Details::class, 'subscriber_account_id');
    }

    public function master()
    {
        return $this->belongsTo(Mt4Details::class, 'master_account_id');
    }
}
