<?php

namespace Rezyon\PaymentManagement\Models;

use Illuminate\Database\Eloquent\Model;

class UserPaymentMethods extends Model
{
    protected $fillable = [
        'domain',
        'type',
        'is_default'
    ];
}