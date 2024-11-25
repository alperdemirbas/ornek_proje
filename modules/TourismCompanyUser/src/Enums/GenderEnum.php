<?php

namespace Rezyon\TourismCompanyUser\Enums;

enum GenderEnum: string
{
    case MALE = 'male';
    case FEMALE = 'female';

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
