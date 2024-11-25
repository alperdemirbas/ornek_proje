<?php

namespace Rezyon\Applications\Supplier\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Rezyon\Applications\Supplier\Enums\PermissionsEnum;
use Rezyon\Companies\Models\Users;

class SupplierPolicy
{
    use HandlesAuthorization;

    public function show(Users $user)
    {
        return ($user->hasPermissionTo(PermissionsEnum::SUPPLIER_ACTIVITY_SHOW));
    }

    public function list(Users $user)
    {
        return ($user->hasPermissionTo(PermissionsEnum::SUPPLIER_ACTIVITY_LIST));
    }

    public function update(Users $user)
    {
        return ($user->hasPermissionTo(PermissionsEnum::SUPPLIER_ACTIVITY_UPDATE));
    }

    public function store(Users $user)
    {
        return ($user->hasPermissionTo(PermissionsEnum::SUPPLIER_ACTIVITY_STORE));
    }

    public function poolPendingApprove(Users $user)
    {
        return ($user->hasPermissionTo(PermissionsEnum::SUPPLIER_ACTIVITY_POOL_PENDING_APPROVE));
    }

    public function poolPendingReject(Users $user)
    {
        return ($user->hasPermissionTo(PermissionsEnum::SUPPLIER_ACTIVITY_POOL_PENDING_REJECT));
    }
}
