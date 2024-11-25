<?php

namespace Rezyon\Users\Enums;

enum Gender: string
{
    case MALE = "MALE";
    case FEMALE = 'FEMALE';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
