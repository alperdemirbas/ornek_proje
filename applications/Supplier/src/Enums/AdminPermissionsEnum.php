<?php

namespace Rezyon\Applications\Supplier\Enums;

enum AdminPermissionsEnum: string
{
    /**
     * Admin tarafında onay beklenilen aktiviteleri listeleme, aktivitenin detayını görme, başvuru detayı, onaylama ve reddetme izinleri.
     */
    case ADMIN_ACTIVITY_PENDING_LIST = 'admin.activity.pending.list';
    case ADMIN_ACTIVITY_PENDING_DETAIL = 'admin.activity.pending.detail';
    case ADMIN_ACTIVITY_PENDING_SHOW = 'admin.activity.pending.show';
    case ADMIN_ACTIVITY_PENDING_CONFIRM = 'admin.activity.pending.confirm';
    case ADMIN_ACTIVITY_PENDING_REJECT = 'admin.activity.pending.reject';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
