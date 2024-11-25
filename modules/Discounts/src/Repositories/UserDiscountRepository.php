<?php

namespace Rezyon\Discounts\Repositories;

use Rezyon\Discounts\Models\UserDiscounts;

class UserDiscountRepository
{
    protected UserDiscounts $model;

    public function __construct(UserDiscounts $model)
    {
        $this->model = $model;
    }

    public function getUserDiscounts(int $userId)
    {
        return $this->model->newQuery()->where('users_id', $userId)->get();
    }

    public function create(array $fields)
    {
        return $this->model->newQuery()->create($fields);
    }

    public function retrieveCode(int $id)
    {
        $model = $this->model->newQuery()->withTrashed()->find($id);
        $model->restore();
        $model->used_at = null;
        return $model->save();
    }

    public function setUsedAt(int $id)
    {
        return $this->model->newQuery()->where('id', $id)->update(['used_at' => now()]);
    }

    public function delete(int $id)
    {
        return $this->model->newQuery()->where('users_id', $id)->delete();
    }
}