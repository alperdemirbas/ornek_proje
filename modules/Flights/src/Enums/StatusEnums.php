<?php

namespace Rezyon\Flights\Enums;

enum StatusEnums: string
{
    case NA = "n/a";
    case CHECKIN = "check_in";
    case CHECKOUT = "check_out";


    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values():array
    {
        return array_column(self::cases(),'value');
    }
}
