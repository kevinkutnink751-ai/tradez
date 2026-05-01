<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mt4Details extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'mt4_id',
        'mt4_password',
        'server',
        'account_type',
        'account_name',
        'currency',
        'balance',
        'leverage',
        'start_date',
        'end_date',
        'status',
        'master_account_id',
        'copy_trade_enabled',
        'subscription_slot',
        'deployment_status',
        'total_profit',
        'total_trades',
        'win_count',
        'loss_count',
        'win_rate',
    ];

    public function tuser()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function transactionLogs()
    {
        return $this->hasMany(Mt4TransactionLog::class, 'subscriber_account_id');
    }

    public function copyTradeRelationship()
    {
        return $this->hasOne(CopyTradeRelationship::class, 'subscriber_account_id');
    }

    public function deploymentRecords()
    {
        return $this->hasMany(DeploymentRecord::class, 'subscriber_account_id');
    }

    public function copyTradeLogs()
    {
        return $this->hasMany(CopyTradeLog::class, 'subscriber_account_id');
    }

    public function masterAccount()
    {
        return $this->belongsTo(MasterAccount::class, 'master_account_id');
    }

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'reminded_at' => 'datetime',
        'verified_at' => 'datetime',
        'copy_trade_enabled' => 'boolean',
    ];

    public function getLoginAttribute()
    {
        return $this->mt4_id;
    }

    public function getPasswordAttribute()
    {
        // Try to decrypt if it looks like an encrypted string, otherwise return as is
        try {
            return \Illuminate\Support\Facades\Crypt::decryptString($this->mt4_password);
        } catch (\Exception $e) {
            return $this->mt4_password;
        }
    }
}