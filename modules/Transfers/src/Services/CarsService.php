<?php

namespace Rezyon\Transfers\Services;

use Rezyon\Transfers\Car;
use Rezyon\Transfers\Repositories\CarsRepository;

class CarsService
{
    protected CarsRepository $repository;

    public function __construct(CarsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getCars(int $companyId)
    {
        return $this->repository->getCars($companyId);
    }

    public function create(Car $car)
    {
        return $this->repository->create([
            'users_id' => $car->getUserId(),
            'name' => $car->getName(),
            'capacity' => $car->getCapacity(),
            'number' => $car->getNumber(),
        ]);
    }

    public function find(int $id)
    {
        return $this->repository->find($id);
    }

    public function update(int $id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->repository->delete($id);
    }
}