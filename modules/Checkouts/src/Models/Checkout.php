<?php

namespace Rezyon\Checkouts\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rezyon\Checkouts\CheckoutStatusEnums;
use Rezyon\Companies\Models\Companies;
use Rezyon\PaymentManagement\Enums\PaymentMethodsEnum;
use Rezyon\Users\Models\Users;

class Checkout extends Model
{
    use HasFactory;
    protected $casts=[
        'status' => CheckoutStatusEnums::class,
        'payment_service' => PaymentMethodsEnum::class,
        'meta' => 'array',
        'success' => 'object',
        'fail' => 'object',
    ];

    protected $fillable = [
        'merchant_oid',
        'users_id',
        'companies_id',
        'payment_service',
        'amount',
        'meta',
        'success',
        'fail',
        'status',
    ];

    public function company()
    {
        return $this->belongsTo(Companies::class,'companies_id');
    }

    public function user()
    {
        return $this->belongsTo(Users::class,'users_id');
    }
}
