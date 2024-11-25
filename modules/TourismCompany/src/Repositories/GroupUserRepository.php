<?php

namespace Rezyon\TourismCompany\Repositories;

use Rezyon\TourismCompany\Models\TourismCompanyGroupUser;

class GroupUserRepository
{
    public function __construct(
        public TourismCompanyGroupUser $tourismCompanyGroupUser
    )
    {

    }

    public function attach(array $data)
    {
        return $this->tourismCompanyGroupUser->newQuery()->create($data);
    }
}