<?php

namespace Rezyon\Orders\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rezyon\Carts\Models\Carts;
use Rezyon\Discounts\Models\Discounts;
use Rezyon\Orders\Enums\OrderReturnStatusEnum;
use Rezyon\Orders\Enums\OrderStatusEnum;
use Rezyon\Orders\Enums\OrderTypeEnum;
use Rezyon\Orders\Enums\PaymentTypeEnum;
use Rezyon\PaymentManagement\Services\Paytr\Enums\CurrencyEnums;
use Rezyon\Users\Models\Users;

class OrderReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        "carts_id",
        "reference_no",
        "return_amount",
        "status",
        "err_no",
        "err_msg",
    ];

    protected $casts = [
        "status" => OrderReturnStatusEnum::class,
    ];

    public function cart()
    {
        return $this->hasOne(Carts::class);
    }
}
