<?php

namespace Rezyon\Supplier\Enums;

enum PriceTypes : string
{
    case ALL = "ALL";
    case WEEKEND = "WEEKEND";

    case WEEK = "WEEK";
    case SPECIAL_DAY = "SPECIAL_DAY";
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