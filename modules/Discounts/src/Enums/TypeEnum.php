<?php

namespace Rezyon\Discounts\Enums;

enum TypeEnum:string
{
    case ACTIVITY = "activity";
    case SUBSCRIPTION = "subscription";

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
