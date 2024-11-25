<?php

namespace Rezyon\Checkouts;

enum CheckoutStatusEnums: string
{
    case WAITING_PAYMENT = "WAITING_PAYMENT";
    case WAITING_RESPONSE = 'WAITING_RESPONSE';
    case WAITING_APPROVAL = 'WAITING_APPROVAL';
    case SUCCESS = 'SUCCESS';
    case FAILED = 'FAILED';

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
