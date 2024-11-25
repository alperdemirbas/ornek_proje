<?php

namespace Rezyon\Checkouts;

use Rezyon\Companies\Models\Companies;
use Rezyon\PaymentManagement\Enums\PaymentMethodsEnum;
use Rezyon\Users\Models\Users;

class Checkout
{
    protected ?Users $users = null;
    protected ?Companies $companies = null;
    protected PaymentMethodsEnum $paymentMethod = PaymentMethodsEnum::PAYTR;
    protected float $amount = 0;
    protected array $meta = [];
    protected array $success = [];
    protected array $fail = [];
    protected CheckoutStatusEnums $checkoutStatusEnums = CheckoutStatusEnums::WAITING_PAYMENT;

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): void
    {
        $this->users = $users;
    }

    public function getCompanies(): ?Companies
    {
        return $this->companies;
    }

    public function setCompanies(?Companies $companies): void
    {
        $this->companies = $companies;
    }

    public function getPaymentMethod(): PaymentMethodsEnum
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(PaymentMethodsEnum $paymentMethod): void
    {
        $this->paymentMethod = $paymentMethod;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    public function getMeta(): string
    {
        return json_encode($this->meta);
    }

    public function setMeta(array $meta): void
    {
        $this->meta = $meta;
    }

    public function getSuccess(): string
    {
        return json_encode($this->success);
    }

    public function setSuccess(array $success): void
    {
        $this->success = $success;
    }

    public function getFail(): string
    {
        return json_encode($this->fail);
    }

    public function setFail(array $fail): void
    {
        $this->fail = $fail;
    }

    public function getCheckoutStatusEnums(): CheckoutStatusEnums
    {
        return $this->checkoutStatusEnums;
    }

    public function setCheckoutStatusEnums(CheckoutStatusEnums $checkoutStatusEnums): void
    {
        $this->checkoutStatusEnums = $checkoutStatusEnums;
    }

}