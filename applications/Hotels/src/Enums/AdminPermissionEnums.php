<?php

namespace Rezyon\Applications\Hotels\Enums;

enum AdminPermissionEnums: string
{
    case ADMIN_HOTELS_ADD = 'admin.hotels.add';
    case ADMIN_HOTELS_LIST = 'admin.hotels.list';
    case ADMIN_HOTELS_SHOW = 'admin.hotels.show';
    case ADMIN_HOTELS_UPDATE = 'admin.hotels.update';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
