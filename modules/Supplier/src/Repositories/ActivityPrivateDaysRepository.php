<?php

namespace Rezyon\Supplier\Repositories;

use Rezyon\Supplier\Models\ActivityPrivateDays;

class ActivityPrivateDaysRepository
{
    protected ActivityPrivateDays $model;

    public function __construct(ActivityPrivateDays $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->model->where('id', $id)->update($data);
    }

    public function delete(int $id)
    {
        return $this->model->where('id', $id)->delete();
    }
}