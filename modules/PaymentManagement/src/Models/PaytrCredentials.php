<?php

namespace Rezyon\PaymentManagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaytrCredentials extends Model
{
    use HasFactory;

    protected $fillable = [
        'domain',
        'merchant_id',
        'merchant_key',
        'merchant_salt'
    ];
}
