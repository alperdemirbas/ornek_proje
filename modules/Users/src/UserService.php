<?php

namespace Rezyon\Users;

use Rezyon\Users\Interfaces\UserRepositoryInterface;

class UserService
{
    public function __construct(public UserRepositoryInterface $repository)
    {

    }

    public function findByAdmin(int $id)
    {
        return $this->repository->findByAdmin($id);
    }

    public function getPnrGroup(string $pnr, int $companiesId)
    {
        return $this->repository->getPnrGroup($pnr, $companiesId);
    }

    public function getUsers(int $companyId)
    {
        return $this->repository->getUsers($companyId);
    }
}