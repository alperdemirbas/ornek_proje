<?php

namespace Rezyon\PaymentManagement\Enums;

enum UserPaymentTypesEnum : string
{
    case ADMIN = "ADMIN";

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values():array
    {
        return array_column(self::cases(),'value');
    }
}
