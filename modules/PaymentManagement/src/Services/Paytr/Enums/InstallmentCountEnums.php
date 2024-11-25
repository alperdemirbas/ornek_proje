<?php

namespace Rezyon\PaymentManagement\Services\Paytr\Enums;

enum InstallmentCountEnums:int
{
    case TWO = 2;
    case  THREE= 3;
    case  FOUR = 4;
    case  FIVE = 5;
    case  SIX = 6;
    case  SEVEN = 7;
    case EIGHT = 8;
    case NINE = 9;
    case TEN = 10;
    case ELEVEN = 11;
    case TWELVE = 12;

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
