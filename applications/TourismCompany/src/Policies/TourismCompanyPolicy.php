<?php

namespace Rezyon\Applications\TourismCompany\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Rezyon\Applications\TourismCompany\Enums\PermissionsEnum;
use Rezyon\Companies\Models\Users;

class TourismCompanyPolicy
{
    use HandlesAuthorization;

    public function show(Users $user)
    {
        return ($user->hasPermissionTo(PermissionsEnum::TOURISM_ACTIVITY_SHOW));
    }

    public function list(Users $user)
    {
        return ($user->hasPermissionTo(PermissionsEnum::TOURISM_ACTIVITY_LIST));
    }

    public function update(Users $user)
    {
        return ($user->hasPermissionTo(PermissionsEnum::TOURISM_ACTIVITY_UPDATE));
    }

    public function store(Users $user)
    {
        return ($user->hasPermissionTo(PermissionsEnum::TOURISM_ACTIVITY_STORE));
    }
}
