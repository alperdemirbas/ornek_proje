<?php

namespace Rezyon\PaymentManagement\Enums;

enum PaymentMethodsEnum: string
{
    case PAYTR = "PAYTR";

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values():array
    {
        return array_column(self::cases(),'value');
    }
}
