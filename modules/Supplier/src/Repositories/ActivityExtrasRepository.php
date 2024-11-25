<?php

namespace Rezyon\Supplier\Repositories;

use Rezyon\Supplier\Models\ActivityExtras;

class ActivityExtrasRepository
{
    protected ActivityExtras $model;

    public function __construct(ActivityExtras $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model->newQuery()->create($data);
    }
}