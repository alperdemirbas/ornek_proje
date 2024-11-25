<?php

namespace Rezyon\Orders;

use Rezyon\Discounts\Models\Discounts;
use Rezyon\Orders\Enums\OrderStatusEnum;
use Rezyon\Orders\Enums\OrderTypeEnum;
use \Rezyon\TourismCompanyUser\Models\Users as TourismCompanyUsers;
use Rezyon\PaymentManagement\Services\Paytr\Enums\CurrencyEnums;
use Rezyon\Users\Models\Users;

class Order
{
    protected Users|TourismCompanyUsers $user;
    protected int $count;
    protected string $merchantOID;
    protected string $ip;
    protected float $amount;
    protected int $installmentCount;
    protected OrderStatusEnum $status;
    protected CurrencyEnums $currency;
    protected ?Discounts $discount = null;
    protected OrderTypeEnum $orderType;

    /**
     * @return TourismCompanyUsers|Users
     */
    public function getUser(): TourismCompanyUsers|Users
    {
        return $this->user;
    }

    /**
     * @param TourismCompanyUsers|Users $user
     */
    public function setUser(TourismCompanyUsers|Users $user): void
    {
        $this->user = $user;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @param int $count
     */
    public function setCount(int $count): void
    {
        $this->count = $count;
    }

    /**
     * @return string
     */
    public function getMerchantOID(): string
    {
        return $this->merchantOID;
    }

    /**
     * @param string $merchantOID
     */
    public function setMerchantOID(string $merchantOID): void
    {
        $this->merchantOID = $merchantOID;
    }

    /**
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     */
    public function setIp(string $ip): void
    {
        $this->ip = $ip;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return int
     */
    public function getInstallmentCount(): int
    {
        return $this->installmentCount;
    }

    /**
     * @param int $installmentCount
     */
    public function setInstallmentCount(int $installmentCount): void
    {
        $this->installmentCount = $installmentCount;
    }

    /**
     * @return OrderStatusEnum
     */
    public function getStatus(): OrderStatusEnum
    {
        return $this->status;
    }

    /**
     * @param OrderStatusEnum $status
     */
    public function setStatus(OrderStatusEnum $status): void
    {
        $this->status = $status;
    }

    /**
     * @return CurrencyEnums
     */
    public function getCurrency(): CurrencyEnums
    {
        return $this->currency;
    }

    /**
     * @param CurrencyEnums $currency
     */
    public function setCurrency(CurrencyEnums $currency): void
    {
        $this->currency = $currency;
    }

    /**
     * @return Discounts|null
     */
    public function getDiscount(): ?Discounts
    {
        return $this->discount;
    }

    /**
     * @param Discounts|null $discount
     */
    public function setDiscount(?Discounts $discount): void
    {
        $this->discount = $discount;
    }

    /**
     * @return OrderTypeEnum
     */
    public function getOrderType(): OrderTypeEnum
    {
        return $this->orderType;
    }

    /**
     * @param OrderTypeEnum $orderType
     */
    public function setOrderType(OrderTypeEnum $orderType): void
    {
        $this->orderType = $orderType;
    }
}