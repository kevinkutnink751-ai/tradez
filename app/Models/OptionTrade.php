<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionTrade extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pair',
        'type',
        'amount',
        'strike_price',
        'expiration',
        'status',
        'pnl',
        'is_demo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
