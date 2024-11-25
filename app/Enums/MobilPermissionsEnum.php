<?php

namespace App\Enums;

enum MobilPermissionsEnum: string
{
    case MOBILE_APP_SETTING = 'mobile.setting';

    public static function values(): array
    {
        return array_column(self::cases(),'value');
    }
}
