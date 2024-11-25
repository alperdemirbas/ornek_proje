<?php

namespace Rezyon\Supplier\Enums;

enum PriceRules : string
{
    case FREE = "FREE";
    case DISCOUNT = "DISCOUNT";
    case DONT_ENTRY = "DONT_ENTRY";
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