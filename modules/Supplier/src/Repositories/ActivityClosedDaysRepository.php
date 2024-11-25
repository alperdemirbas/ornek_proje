<?php

namespace Rezyon\Supplier\Repositories;

use Rezyon\Supplier\Models\ActivityClosedDay;

class ActivityClosedDaysRepository
{
    protected ActivityClosedDay $model;

    public function __construct(ActivityClosedDay $model)
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