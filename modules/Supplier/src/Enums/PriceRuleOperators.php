<?php

namespace Rezyon\Supplier\Enums;

enum PriceRuleOperators : string
{
    case LOWER  ="LOWER";
    case BIGGER = "BIGGER";
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
    public static function valueFromString(string $name): self
    {
        return constant("self::$name");
    }
}