<?php

namespace Rezyon\Users\Enums;

enum Types : string
{
    case SUPPLIER = 'SUPPLIER';
    case TOURISM_COMPANY = 'TOURISM_COMPANY';
    case CUSTOMER = 'CUSTOMER';

    case ADMIN = 'ADMIN';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
