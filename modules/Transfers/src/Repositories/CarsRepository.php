<?php

namespace Rezyon\Transfers\Repositories;

use Rezyon\Transfers\Models\Cars;

class CarsRepository
{
    protected Cars $model;

    public function __construct(Cars $model)
    {
        $this->model = $model;
    }

    public function getCars(int $companyId)
    {
        return $this->model->newQuery()->withWhereHas('user', function($query) use($companyId) {
            $query->select('id', 'companies_id');
            $query->where('companies_id', $companyId);
        })->get();
    }

    public function create(array $data)
    {
        return $this->model->newQuery()->create($data);
    }

    public function find(int $id)
    {
        return $this->model->newQuery()->find($id);
    }

    public function update(int $id, array $data)
    {
        return $this->model->newQuery()->where('id', $id)->update($data);
    }

    public function delete(int $id)
    {
        return $this->model->newQuery()->where('id', $id)->delete();
    }

}