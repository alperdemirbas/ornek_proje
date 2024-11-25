<?php

namespace Rezyon\Flights\Enums;

enum FlightStatusEnums : string
{
    case ACTIVE = "active"; //Aktif
    case LANDED = "landed"; //uçak indi
    case RETURNED = "returned"; //uçak geri döndü
    case CANCELLED = "cancelled"; //iptal edildi

    public static function names():array
    {
        return array_column(self::cases(),'name');
    }

    public static function values():array
    {
        return array_column(self::cases(),'value');
    }

}
