<?php

namespace Rezyon\Companies\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Rezyon\Companies\Interfaces\UserInfoRepositoryInterface;
use Rezyon\Companies\Models\UserInfo;

class UserInfoRepository implements UserInfoRepositoryInterface
{
    protected Builder $builder;
    public function __construct(public UserInfo $user)
    {
        $this->builder = $this->user->newQuery();
    }

    public function create(array $array)
    {
        return $this->builder->create($array);
    }

    public function find(int $id)
    {

    }

    public function update(int $id,array $payload)
    {

    }

    public function delete(int $id)
    {

    }
}