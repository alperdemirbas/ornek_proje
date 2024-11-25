<?php

namespace Rezyon\Applications\Companies\Policies;


use Rezyon\Applications\Companies\Enums\AdminPermissionsEnum;
use Rezyon\Applications\TourismCompany\Enums\PermissionsEnum as TourismPermissionsEnum;
use Rezyon\Applications\Supplier\Enums\PermissionsEnum as SupplierPermissionsEnum;

use Illuminate\Auth\Access\HandlesAuthorization;
use Rezyon\Users\Models\Users;

class CompaniesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     */
    public function view(Users $user): bool
    {
        return ($user->hasPermissionTo(AdminPermissionsEnum::ADMIN_SHOW));
    }

    public function attachUser(Users $user)
    {
        return ($user->hasPermissionTo(AdminPermissionsEnum::ADMIN_APPROVE));
    }

    public function approve(Users $user)
    {
        return ($user->hasPermissionTo(AdminPermissionsEnum::ADMIN_APPROVE));
    }
    public function showWaitingApproval(Users $user): bool
    {
        return ($user->hasPermissionTo(AdminPermissionsEnum::ADMIN_SHOW_WAITING_APPROVE));
    }

    public function editWaitingApprovalEdit(Users $user): bool
    {
        return ($user->hasPermissionTo(AdminPermissionsEnum::ADMIN_EDIT_WAITING_APPROVE));
    }

    public function getWaitingApproval(Users $user):bool
    {
        return ($user->hasPermissionTo(AdminPermissionsEnum::ADMIN_SHOW_WAITING_APPROVE));
    }

    public function checkDomain(Users $user): bool
    {
        return ($user->hasPermissionTo(AdminPermissionsEnum::ADMIN_CHECK_DOMAIN));
    }

    public function domainList(Users $user)
    {
        return ($user->hasPermissionTo(AdminPermissionsEnum::ADMIN_DOMAIN_LIST));
    }

    public function subUserStore(Users $user): bool
    {
        return ($user->hasPermissionTo(TourismPermissionsEnum::TOURISM_SUBUSER_STORE) || $user->hasPermissionTo(SupplierPermissionsEnum::SUPPLIER_SUBUSER_STORE));
    }

    public function subUserUpdate(Users $user): bool
    {
        return ($user->hasPermissionTo(TourismPermissionsEnum::TOURISM_SUBUSER_UPDATE) || $user->hasPermissionTo(SupplierPermissionsEnum::SUPPLIER_SUBUSER_UPDATE));
    }

    public function showPackages(Users $user): bool
    {
        return ($user->hasPermissionTo(AdminPermissionsEnum::ADMIN_COMPANY_SHOW_PACKAGES));
    }

    public function showUsers(Users $user): bool
    {
        return ($user->hasPermissionTo(AdminPermissionsEnum::ADMIN_COMPANY_SHOW_USERS));
    }

    public function showOfficials(Users $user): bool
    {
        return ($user->hasPermissionTo(AdminPermissionsEnum::ADMIN_COMPANY_SHOW_OFFICIALS));
    }

    /**
     * @description Firma yetkilisini silme yetkisi
     * @param Users $user
     * @return bool
     */
    public function destroyOfficials(Users $user): bool
    {
        return ($user->hasPermissionTo(AdminPermissionsEnum::ADMIN_COMPANY_DELETE_OFFICIALS));
    }

    public function showCustomers(Users $user): bool
    {
        return ($user->hasPermissionTo(AdminPermissionsEnum::ADMIN_COMPANY_SHOW_CUSTOMERS));
    }

    public function showActivityPool(Users $user): bool
    {
        return ($user->hasPermissionTo(AdminPermissionsEnum::ADMIN_COMPANY_SHOW_ACTIVITY_POOL));
    }

    public function showActivities(Users $user): bool
    {
        return ($user->hasPermissionTo(AdminPermissionsEnum::ADMIN_COMPANY_SHOW_ACTIVITIES));
    }

    public function showSupplierCustomers(Users $user): bool
    {
        return ($user->hasPermissionTo(AdminPermissionsEnum::ADMIN_COMPANY_SHOW_SUPPLIER_CUSTOMERS));
    }
}
