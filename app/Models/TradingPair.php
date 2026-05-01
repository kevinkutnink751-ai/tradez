<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradingPair extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'symbol',
        'base_asset',
        'type',
        'min_amount',
        'max_amount',
        'leverage',
        'status',
    ];
}
