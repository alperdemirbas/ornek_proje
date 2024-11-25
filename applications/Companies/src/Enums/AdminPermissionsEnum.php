<?php

namespace Rezyon\Applications\Companies\Enums;

enum AdminPermissionsEnum: string
{
    case ADMIN_APPROVE = 'admin.companies.approve'; //Onaylayabilir
    case ADMIN_SHOW_WAITING_APPROVE = 'admin.companies.show_approve'; // Onay Bekleyenleri gorebilir
    case ADMIN_EDIT_WAITING_APPROVE = 'admin.companies.edit_approve'; // Onay Bekleyen Kullanicilari Duzenleyebilir
    case ADMIN_ATTACH_USER = 'admin.companies.attach_user'; // Firmaya Kullanici Ekleyebilir
    case ADMIN_SHOW = 'admin.companies.show'; // Firmalarin listesini goruntuleyebilir
    case ADMIN_EDIT = 'admin.companies.edit'; // Firmalari Duzenleyebilir
    case ADMIN_CHECK_DOMAIN = 'admin.domain.check';
    case ADMIN_DOMAIN_LIST ='admin.domain.list';
    case ADMIN_OFFICIALS_LIST = 'admin.companies.officials.list'; // Yetkililerin listesini görebilme.
    case ADMIN_OFFICIALS_EDIT = 'admin.companies.officials.edit'; // Yetkilileri düzenleyebilir.
    case ADMIN_OFFICIALS_DELETE = 'admin.companies.officials.delete'; // Yetkilileri silebilir.
    case ADMIN_OFFICIALS_STORE = 'admin.companies.officials.store'; // Yetkili ekleyebilir.

    case ADMIN_COMPANY_SHOW_PACKAGES = 'admin.companies.show.packages';
    case ADMIN_COMPANY_SHOW_USERS = 'admin.companies.show.users';
    case ADMIN_COMPANY_SHOW_OFFICIALS = 'admin.companies.show.officials';
    case ADMIN_COMPANY_SHOW_CUSTOMERS = 'admin.companies.show.customers';
    case ADMIN_COMPANY_SHOW_ACTIVITY_POOL = 'admin.companies.show.activity_pool';
    case ADMIN_COMPANY_SHOW_DOCUMENTS = 'admin.companies.show.documents';
    case ADMIN_COMPANY_SHOW_ACTIVITIES = 'admin.companies.show.activities';
    case ADMIN_COMPANY_SHOW_SUPPLIER_CUSTOMERS = 'admin.companies.show.supplier.customers';
    /**
     * Firmaların yetkililerini silme yetkisi
     */
    case ADMIN_COMPANY_DELETE_OFFICIALS = 'admin.companies.delete.officials';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }


}
