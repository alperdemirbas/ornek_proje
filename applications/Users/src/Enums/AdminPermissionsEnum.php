<?php

namespace Rezyon\Applications\Users\Enums;

enum AdminPermissionsEnum: string
{
    case ADMIN_USER_SHOW = 'admin.users.show'; // Kullanıcıları görüntüleyebilir.
    case ADMIN_USER_DELETE = 'admin.users.delete'; // Kullanıcı Silebilir
    case ADMIN_USER_LIST = 'admin.users.list'; // Kullanıcıları Listeleyebilir
    case ADMIN_USER_EDIT_PASSWORD = 'admin.users.edit.password'; // Kullanıcının şifresini değiştireiblir.
    case ADMIN_USER_EDIT_PERMISSIONS = 'admin.users.edit.permissions'; // Kullanıcının yetkilerini güncelleyebiir.

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }


}
