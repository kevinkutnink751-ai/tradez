<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $table = 'payment_methods';

    protected $fillable = [
        'name',
        'slug',
        'minimum',
        'maximum',
        'charges_amount',
        'charges_type',
        'duration',
        'methodtype',
        'img_url',
        'bankname',
        'account_name',
        'account_number',
        'swift_code',
        'wallet_address',
        'barcode',
        'network',
        'type',
        'status',
        'defaultpay',
    ];
}
