<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeploymentRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscriber_account_id',
        'type', // DEPLOY, UNDEPLOY
        'status', // SUCCESS, FAILED
        'admin_id',
        'error',
    ];

    public function mt4Details()
    {
        return $this->belongsTo(Mt4Details::class, 'subscriber_account_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
