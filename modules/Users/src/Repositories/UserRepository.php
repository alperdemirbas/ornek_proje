<?php

namespace Rezyon\Users\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Rezyon\Users\Enums\Types;
use Rezyon\Users\Interfaces\UserRepositoryInterface;
use Rezyon\Users\Models\Users;

class UserRepository implements UserRepositoryInterface
{
    protected Builder $builder;

    public function __construct(public Users $users)
    {
        $this->builder = $this->users->newQuery();
    }

    public function findByAdmin(int $id)
    {
        return $this->builder->where('type', Types::ADMIN)->find($id);
    }

    public function getPnrGroup(string $pnr, int $companiesId)
    {
        return $this->builder->where(['pnr' => $pnr, 'companies_id' => $companiesId])->get();
    }

    public function getUsers(int $companyId)
    {
        return $this->builder->where('companies_id', $companyId)->get();
    }
}













