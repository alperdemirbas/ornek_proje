<?php

namespace Rezyon\Applications\Supplier\Enums;

enum PermissionsEnum: string
{
    case SUPPLIER_ACTIVITY_STORE = 'supplier.activity.store';
    case SUPPLIER_ACTIVITY_LIST= 'supplier.activity.list';
    case SUPPLIER_ACTIVITY_SHOW = 'supplier.activity.show';
    case SUPPLIER_ACTIVITY_UPDATE = 'supplier.activity.update';

    case SUPPLIER_ACTIVITY_POOL_PENDING_LIST = 'supplier.activity.pool.pending.list';
    case SUPPLIER_ACTIVITY_POOL_PENDING_APPROVE = 'supplier.activity.pool.pending.approve';
    case SUPPLIER_ACTIVITY_POOL_PENDING_REJECT = 'supplier.activity.pool.pending.reject';
    case SUPPLIER_ACTIVITY_POOL_PENDING_SHOW = 'supplier.activity.pool.pending.show';

    case SUPPLIER_SUBUSER_STORE = 'supplier.subuser.store';
    case SUPPLIER_SUBUSER_UPDATE = 'supplier.subuser.update';
    case SUPPLIER_GIVE_PERMISSONS = 'supplier.give.permissions';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
