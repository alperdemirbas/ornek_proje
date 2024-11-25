<?php

namespace Rezyon\Applications\Packages\Enums;

enum AdminPermissionsEnum: string
{
    case ADMIN_PACKAGE_STORE = 'admin.package.store';
    case ADMIN_PACKAGE_LIST= 'admin.package.list';
    case ADMIN_PACKAGE_SHOW = 'admin.package.show';
    case ADMIN_PACKAGE_UPDATE = 'admin.package.update';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }


}
