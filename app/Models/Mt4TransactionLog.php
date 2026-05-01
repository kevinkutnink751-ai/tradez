<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mt4TransactionLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscriber_account_id',
        'user_id',
        'admin_id',
        'action',
        'before_status',
        'after_status',
        'details',
        'api_response',
    ];

    protected $casts = [
        'details' => 'json',
        'api_response' => 'json',
    ];

    public function mt4Details()
    {
        return $this->belongsTo(Mt4Details::class, 'subscriber_account_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
