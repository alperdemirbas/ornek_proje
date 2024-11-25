<?php

namespace Rezyon\Orders\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rezyon\Carts\Models\Carts;
use Rezyon\Discounts\Models\Discounts;
use Rezyon\Orders\Enums\OrderStatusEnum;
use Rezyon\Orders\Enums\OrderTypeEnum;
use Rezyon\Orders\Enums\PaymentTypeEnum;
use Rezyon\PaymentManagement\Services\Paytr\Enums\CurrencyEnums;
use Rezyon\Users\Models\Users;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        "users_id",
        "count",
        "merchant_oid",
        "user_ip",
        "amount",
        "total_amount",
        "installment_count",
        "status",
        "currency",
        "discounts_id",
        "failed_reason_code",
        "failed_reason_msg",
        "payment_type",
        "order_type"
    ];

    protected $casts = [
        "order_type" => OrderTypeEnum::class,
        "payment_type" => PaymentTypeEnum::class,
        "currency" => CurrencyEnums::class,
        "status" => OrderStatusEnum::class
    ];

    public function user()
    {
        return $this->belongsTo(Users::class, 'users_id', 'id');
    }

    public function cart()
    {
        return $this->hasMany(Carts::class, 'orders_id', 'id');
    }

    public function discount()
    {
        return $this->belongsTo(Discounts::class, 'discounts_id', 'id');
    }
}
