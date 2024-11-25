<?php

namespace Rezyon\Supplier\Repositories;

use Rezyon\Supplier\Models\ActivityCancellationConditions;

class ActivityCancellationConditionsRepository
{
    protected ActivityCancellationConditions $model;
    
    public function __construct(ActivityCancellationConditions $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model->newQuery()->create($data);
    }
}