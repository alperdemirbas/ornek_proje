<?php

namespace Rezyon\Applications\TourismCompany\Enums;

enum PermissionsEnum: string
{
    case TOURISM_ACTIVITY_STORE = 'tourism.activity.store';
    case TOURISM_ACTIVITY_LIST= 'tourism.activity.list';
    case TOURISM_ACTIVITY_SHOW = 'tourism.activity.show';
    case TOURISM_ACTIVITY_UPDATE = 'tourism.activity.update';
    case TOURISM_ACTIVITY_DELETE = 'tourism.activity.delete';


    case TOURISM_SUBUSER_STORE = 'tourism.subuser.store';
    case TOURISM_SUBUSER_UPDATE = 'tourism.subuser.update';
    case TOURISM_GIVE_PERMISSONS = 'tourism.give.permissions';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
