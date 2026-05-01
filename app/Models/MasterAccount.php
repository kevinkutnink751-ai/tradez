<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_name',
        'name',
        'account_type',
        'currency',
        'leverage',
        'strategy_name',
        'strategy_description',
        'strategy_mode',
        'stra_com',
        'account_balance',
        'is_active',
        'total_profit',
        'total_trades',
        'win_count',
        'loss_count',
        'win_rate',
        'roi',
        'risk_level',
        'drawdown',
        'bot_type',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'account_balance' => 'decimal:2',
        'roi' => 'decimal:2',
        'drawdown' => 'decimal:2',
    ];

    public function getPnlAttribute()
    {
        return $this->roi; // Map ROI to PNL for the view
    }

    public function getNameAttribute($value)
    {
        return $value ?? $this->account_name;
    }
}
