<?php

namespace Rezyon\Packages\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Rezyon\Packages\Interfaces\PackagesRepositoryInterface;
use Rezyon\Packages\Models\Packages;



/**
 *
 */
class PackagesRepository implements PackagesRepositoryInterface
{
    /**
     * @var Packages
     */
    protected Packages $packages;
    /**
     * @var Builder
     */
    protected Builder $query;

    /**
     * @param Packages $packages
     */
    public function __construct(Packages $packages)
    {
        $this->packages = $packages;
        $this->query = $packages->newQuery();
    }

    /**
     * @param array $package
     * @return Builder|Model
     */
    public function create(array $package): Model|Builder
    {
        return $this->query->create($package);
    }

    /**
     * @return array|Collection
     */
    public function get(): array|Collection
    {
        return $this->query->get();
    }

    public function find(int $id)
    {
        return $this->query->find($id);
    }

    public function all()
    {
        return $this->query->where('is_active',1)->get();
    }

    public function update(int $id , array $fill): int
    {
        return $this->packages->newQuery()->where('id' , $id )->update($fill);
    }

}