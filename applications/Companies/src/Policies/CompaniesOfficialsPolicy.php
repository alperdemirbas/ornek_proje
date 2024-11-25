<?php

namespace Rezyon\Applications\Companies\Policies;


use Rezyon\Applications\Companies\Enums\AdminPermissionsEnum;

use Illuminate\Auth\Access\HandlesAuthorization;
use Rezyon\Users\Models\Users;

class CompaniesOfficialsPolicy
{
    use HandlesAuthorization;

    public function list(Users $user)
    {
        return ($user->hasPermissionTo(AdminPermissionsEnum::ADMIN_OFFICIALS_LIST));
    }

    public function store(Users $user)
    {
        return ($user->hasPermissionTo(AdminPermissionsEnum::ADMIN_OFFICIALS_STORE));
    }

    public function edit(Users $user)
    {
        return ($user->hasPermissionTo(AdminPermissionsEnum::ADMIN_OFFICIALS_EDIT));
    }

    public function destroy(Users $user)
    {
        return ($user->hasPermissionTo(AdminPermissionsEnum::ADMIN_OFFICIALS_DELETE));
    }
}
