<?php

namespace Rezyon\TourismCompany;

use Rezyon\TourismCompany\Models\TourismCompanyGroup;
use Rezyon\TourismCompany\Repositories\GroupRepository;
use Rezyon\TourismCompany\Repositories\GroupUserRepository;
use Rezyon\TourismCompanyUser\Models\Users;

class GroupService
{
    public function __construct(
        public GroupRepository     $repository,
        public GroupUserRepository $groupUserRepository,
    )
    {
    }

    public function store(Group $group)
    {
        return $this->repository->store(
            $group->toArray()
        );
    }

    public function update(int $groupId, Group $group): void
    {
        $this->repository->update( $groupId ,
            $group->toArray()
        );
    }

    public function attachNewUser(TourismCompanyGroup $group, Users $users, string $subDomain = null)
    {
        return $this->groupUserRepository->attach([
            'users_id' => $users->id,
            'tourism_company_group_id' => $group->id,
            'sub_group_id' => $subDomain,
        ]);
    }
}