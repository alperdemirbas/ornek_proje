<?php

namespace Rezyon\Orders\Enums;

enum PaymentTypeEnum:string
{
    case CARD = "card";
    case EFT = "eft";

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values():array
    {
        return array_column(self::cases(),'value');
    }
}
