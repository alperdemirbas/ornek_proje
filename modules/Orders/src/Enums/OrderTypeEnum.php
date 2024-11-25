<?php

namespace Rezyon\Orders\Enums;

enum OrderTypeEnum:string
{
    case SUBSCRIPTION = "subscription"; //abonelik satın alma
    case ONETIME = "onetime"; //aktivite satın alma

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values():array
    {
        return array_column(self::cases(),'value');
    }
}
