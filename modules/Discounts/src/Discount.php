<?php

namespace Rezyon\Discounts;

use Carbon\Carbon;
use Rezyon\Discounts\Enums\TypeEnum;
use Rezyon\Users\Models\Users;

class Discount
{
    protected int $discountRate;
    protected int $maxUsing;
    protected Users $user;
    protected string $code;
    protected TypeEnum $type;
    protected Carbon $validityDate;

    /**
     * @return int
     */
    public function getDiscountRate(): int
    {
        return $this->discountRate;
    }

    /**
     * @param int $discountRate
     */
    public function setDiscountRate(int $discountRate): void
    {
        $this->discountRate = $discountRate;
    }

    /**
     * @return int
     */
    public function getMaxUsing(): int
    {
        return $this->maxUsing;
    }

    /**
     * @param int $maxUsing
     */
    public function setMaxUsing(int $maxUsing): void
    {
        $this->maxUsing = $maxUsing;
    }

    /**
     * @return Users
     */
    public function getUser(): Users
    {
        return $this->user;
    }

    /**
     * @param Users $user
     */
    public function setUser(Users $user): void
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return TypeEnum
     */
    public function getType(): TypeEnum
    {
        return $this->type;
    }

    /**
     * @param TypeEnum $type
     */
    public function setType(TypeEnum $type): void
    {
        $this->type = $type;
    }

    /**
     * @return Carbon
     */
    public function getValidityDate(): Carbon
    {
        return $this->validityDate;
    }

    /**
     * @param Carbon $validityDate
     */
    public function setValidityDate(Carbon $validityDate): void
    {
        $this->validityDate = $validityDate;
    }
}