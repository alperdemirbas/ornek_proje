<?php

namespace Rezyon\Packages;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Rezyon\Packages\Enums\PackageTypesEnums;
use Rezyon\Packages\Interfaces\PackagesRepositoryInterface;
use Rezyon\Packages\Repositories\PackagesRepository;
use Rezyon\Packages\Interfaces\PackagesInterface;
use Rezyon\Packages\Interfaces\PackagesServiceInterface;

class PackagesService implements PackagesServiceInterface
{

    public function __construct(
        public PackagesRepositoryInterface $repository
    )
    {

    }

    public function create(PackagesInterface $package)
    {
        return $this
            ->repository
            ->create([
                "name" => $package->getName(),
                'is_active' => $package->isIsActive(),
                'quarter_yearly_discount' => $package->getQuarterYearlyDiscount(),
                'half_yearly_discount' => $package->getHalfYearlyDiscount(),
                'yearly_discount' => $package->getYearlyDiscount(),
                'fee' => $package->getFee(),
                'type' => $package->getTypesEnums(),
            ]);
    }

    public function find(int $id)
    {
        return $this->repository->find($id);
    }

    public function all()
    {
        return $this->repository->all();
    }


    public function allWithInActive()
    {
        return $this->repository->get();
    }

    public function update(int $id , array $fill)
    {
        return $this->repository->update($id , $fill);
    }
}