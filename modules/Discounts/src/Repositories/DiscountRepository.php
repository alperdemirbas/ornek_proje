<?php

namespace Rezyon\Discounts\Repositories;

use Rezyon\Discounts\Models\Discounts;

class DiscountRepository
{
    protected Discounts $model;

    public function __construct(Discounts $model)
    {
        $this->model = $model;
    }

    public function findByCode(string $code)
    {
        return $this->model->newQuery()->where('code', $code)->first();
    }

    public function create(array $fields)
    {
        return $this->model->newQuery()->create($fields);
    }

    public function useCode(int $userId, string $code)
    {
        return $this->model->newQuery()->where('code', $code)->update([
            'using_user' => $userId,
            'used_at' => now(),
        ]);
    }
}