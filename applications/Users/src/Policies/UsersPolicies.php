<?php

namespace Rezyon\Applications\Users\Policies;

use Illuminate\Support\Facades\Auth;
use Rezyon\Applications\Users\Enums\AdminPermissionsEnum;
use Rezyon\Users\Models\Users;

class UsersPolicies
{
    public function list(Users $user)
    {
        return ($user->hasPermissionTo(AdminPermissionsEnum::ADMIN_USER_LIST));

    }

    public function show(Users $user)
    {
        return true;

        /*return (
            $user->hasPermissionTo(AdminPermissionsEnum::ADMIN_USER_SHOW) &&
            request()->route('id') !== (string)Auth::user()->id
        );*/
    }
}