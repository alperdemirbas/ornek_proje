<?php

namespace Rezyon\TourismCompany\Enums;

enum GroupStatus : string
{
    case WAITING_ARRIVE = "WAITING_ARRIVE";
    case SALES = "SALES";
    case DONE = "DONE";
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