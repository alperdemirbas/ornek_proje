<?php

namespace Rezyon\Supplier\Enums;

enum ActivityExtraTypeEnum: string
{
    case INCLUDE_PRICE = 'include_price';
    case NOT_INCLUDE_PRICE = 'not_include_price';
    case ADVICE = 'advice';

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
