<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    protected $fillable = [
        'txn_id',
        'user',
        'amount',
        'payment_mode',
        'plan',
        'status',
        'proof',
        'wallet',
        'asset_id',
        'balance_type',
    ];

    public function duser(){
    	return $this->belongsTo('App\Models\User', 'user');
    }

    public function dplan(){
    	return $this->belongsTo('App\Models\Plans', 'plan');
    }

    public function asset()
    {
        return $this->belongsTo(\App\Models\Asset::class);
    }
}
