<?php

namespace Rezyon\Applications\Hotels\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Rezyon\Applications\Hotels\Enums\AdminPermissionEnums;
use Rezyon\Applications\Hotels\Enums\CompanyPermissionEnums;
use Rezyon\Users\Models\Users;
use Rezyon\Companies\Models\Users as CompanyUser;

class HotelsPolicy
{
    use HandlesAuthorization;

    public function list(Users $user)
    {
        return ($user->hasPermissionTo(AdminPermissionEnums::ADMIN_HOTELS_LIST));
    }

    public function show(Users $user)
    {
        return ($user->hasPermissionTo(AdminPermissionEnums::ADMIN_HOTELS_SHOW));
    }

    public function edit(Users $user)
    {
        return ($user->hasPermissionTo(AdminPermissionEnums::ADMIN_HOTELS_UPDATE));
    }

    public function add(Users $user)
    {
        return ($user->hasPermissionTo(AdminPermissionEnums::ADMIN_HOTELS_ADD));
    }

    public function assignmentList($user)
    {
        $companyUser = $this->getCompanyUser($user);
        return ($companyUser->hasPermissionTo(CompanyPermissionEnums::HOTELS_ASSIGNMENT_LIST));
    }

    public function assignmentCreate($user)
    {
        $companyUser = $this->getCompanyUser($user);
        return ($companyUser->hasPermissionTo(CompanyPermissionEnums::HOTELS_ASSIGNMENT_CREATE));
    }

    public function assignmentUpdate($user)
    {
        $companyUser = $this->getCompanyUser($user);
        return ($companyUser->hasPermissionTo(CompanyPermissionEnums::HOTELS_ASSIGNMENT_UPDATE));
    }

    public function assignmentDelete($user)
    {
        $companyUser = $this->getCompanyUser($user);
        return ($companyUser->hasPermissionTo(CompanyPermissionEnums::HOTELS_ASSIGNMENT_DELETE));
    }

    private function getCompanyUser($user)
    {
        if ($user instanceof Users) {
            // `Users` modelinden `CompanyUser` modeline dönüştürme işlemi
            // Bu örnek bir dönüşümdür, kendi dönüşüm mantığınızı buraya yazın
            return CompanyUser::find($user->id);
        }

        return $user;
    }
}
