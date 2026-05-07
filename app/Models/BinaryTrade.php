<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BinaryTrade extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'coin_pair',
        'amount',
        'win_amount',
        'direction',
        'duration',
        'status',
        'result',
        'strike_price',
        'end_price',
        'is_demo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
