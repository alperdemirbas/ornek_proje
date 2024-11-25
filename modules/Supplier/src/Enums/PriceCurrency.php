<?php

namespace Rezyon\Supplier\Enums;

enum PriceCurrency : string
{
    case TRY = "TRY";
    case USD = "USD";
    case EUR = "EUR";
    case GBP = 'GBP';
    case IRR= 'IRR';
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function valueFromString(string $name)
    {
        return constant("self::$name");
    }
}