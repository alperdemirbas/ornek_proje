<?php

namespace Rezyon\Applications\Hotels\Enums;

enum CompanyPermissionEnums: string
{
    case HOTELS_ASSIGNMENT_LIST = 'hotels.assignment.list';
    case HOTELS_ASSIGNMENT_CREATE = 'hotels.assignment.create';
    case HOTELS_ASSIGNMENT_UPDATE = 'hotels.assignment.update';
    case HOTELS_ASSIGNMENT_DELETE = 'hotels.assignment.delete';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
