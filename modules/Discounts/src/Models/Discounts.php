<?php

namespace Rezyon\Discounts\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rezyon\Discounts\Enums\TypeEnum;
use Rezyon\Discounts\Repositories\UserDiscountRepository;
use Rezyon\Orders\Models\Orders;

class Discounts extends Model
{
    use HasFactory;

    protected $fillable = [
        'discount_rate',
        'max_using',
        'users_id',
        'code',
        'validity_date'
    ];

    protected $casts = [
        'type' => TypeEnum::class
    ];

    public function orders()
    {
        return $this->hasMany(Orders::class);
    }

    public function userDiscount()
    {
        return $this->hasMany(UserDiscounts::class);
    }
}
