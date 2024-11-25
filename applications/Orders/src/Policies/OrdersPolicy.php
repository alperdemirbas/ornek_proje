<?php

namespace Rezyon\Applications\Packages\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Rezyon\Applications\Packages\Enums\AdminPermissionsEnum;
use Rezyon\Users\Models\Users;

class OrdersPolicy
{
    use HandlesAuthorization;

    public function list(Users $user)
    {
        return ($user->hasPermissionTo(AdminPermissionsEnum::ADMIN_PACKAGE_LIST));
    }

    public function show(Users $user)
    {
        return ($user->hasPermissionTo(AdminPermissionsEnum::ADMIN_PACKAGE_SHOW));
    }
    public function edit(Users $user)
    {
        return ($user->hasPermissionTo(AdminPermissionsEnum::ADMIN_PACKAGE_UPDATE));
    }
    public function store(Users $user)
    {
        return ($user->hasPermissionTo(AdminPermissionsEnum::ADMIN_PACKAGE_STORE));
    }
}
