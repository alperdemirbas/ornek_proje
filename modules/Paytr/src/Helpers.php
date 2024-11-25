<?php

namespace Rezyon\Paytr;

class Helpers
{
    /**
     * @var
     */
    protected $amount;

    /**
     * @return string
     */
    public static function MerchantOID(): string
    {
        return "11" . rand(1, 999) . rand(1, 88) * rand(1, 150) . time();
    }

    /**
     * @param $amount
     * @return float|int
     */
    public static function amount($amount): float|int
    {
        return $amount * 100;
    }
}
