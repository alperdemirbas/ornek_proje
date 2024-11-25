<?php

namespace Rezyon\PaymentManagement\Services\Paytr\Enums;

enum CurrencyEnums: string
{
    case TRY = "TRY";
    case TL = "TL";
    case EURO = "EUR";
    case USD = "USD";
    case POUND = "GBP";
    case RUBLE = "RUB";

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
