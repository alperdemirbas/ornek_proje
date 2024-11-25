<?php

namespace Rezyon\TourismCompany\Enums;

enum GroupTypes : string
{
    case FLIGHT = "FLIGHT";
    case BUS = "BUS";
    case OTHER = "OTHER";
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