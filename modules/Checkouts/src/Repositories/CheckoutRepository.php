<?php

namespace Rezyon\Checkouts\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Rezyon\Checkouts\Models\Checkout;
use Rezyon\Companies\Enums\PaymentStatusesEnums;

class CheckoutRepository
{
    protected Builder $builder;

    public function __construct(
        public Checkout $checkout
    )
    {
        $this->builder = $this->checkout->newQuery()->with(['user','company']);
    }

    public function create(array $array)
    {
        return $this->builder->create($array);
    }

    public function setStatus(string $merchantOid, PaymentStatusesEnums $paymentStatusesEnums)
    {
        return $this->checkout
            ->newQuery()
            ->where([
                'merchant_oid' => $merchantOid,
                'status' => PaymentStatusesEnums::WAITING_PAYMENT
            ])->update([
                'status' => $paymentStatusesEnums
            ]);
    }

    public function findByMerchantOid(string $merchant_oid)
    {
        return $this->builder->where('merchant_oid',$merchant_oid)->first();
    }
}