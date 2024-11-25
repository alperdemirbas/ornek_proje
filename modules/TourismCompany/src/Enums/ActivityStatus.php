<?php

namespace Rezyon\TourismCompany\Enums;

enum ActivityStatus : string
{
    case ACTIVE = 'ACTIVE';
    case PASSIVE = 'PASSIVE';
    case WAITING_APPROVE = 'WAITING_APPROVE';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

}
