<?php

namespace Rezyon\Transfers\Repositories;

use Rezyon\Transfers\Models\Transfers;

class TransfersRepository
{
    protected Transfers $model;

    public function __construct(Transfers $model)
    {
        $this->model = $model;
    }

    public function find(int $id)
    {
        return $this->model->newQuery()->where('id', $id)->with('transferUsers')->first();
    }

    public function create(array $data)
    {
        return $this->model->newQuery()->create($data);
    }

    public function delete(int $id)
    {
        return $this->model->where('id', $id)->delete();
    }
}