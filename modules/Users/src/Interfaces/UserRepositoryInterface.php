<?php

namespace Rezyon\Users\Interfaces;

interface UserRepositoryInterface
{
    public function findByAdmin(int $id);

    public function getUsers(int $companyId);
}