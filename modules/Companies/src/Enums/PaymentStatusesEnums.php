<?php

namespace Rezyon\Companies\Enums;

enum PaymentStatusesEnums : string
{
    case WAITING_VERIFICATION = 'WAITING_VERIFICATION';
    case WAITING_PAYMENT = 'WAITING_PAYMENT';
    case WAITING_APPROVAL = 'WAITING_APPROVAL';
    case PAYMENT_SUCCESS = 'PAYMENT_SUCCESS';
    case PAYMENT_ERROR='PAYMENT_ERROR';
    case PACKAGE_CHANGE='PACKAGE_CHANGE';
    case FINISHED='FINISHED';
    case DEMO='DEMO';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function valueFromString(string $name): self
    {
        return constant("self::$name");
    }

}
