<?php

namespace Rezyon\Companies\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Rezyon\Companies\Interfaces\CompaniesRepositoryInterface;
use Rezyon\Companies\Models\Companies;
use Rezyon\TourismCompany\Models\TourismCompanyGroup;

/**
 *
 */
class CompaniesRepository implements CompaniesRepositoryInterface
{
    /**
     * @var Builder
     */
    protected Builder $builder;

    /**
     * @param Companies $companies
     */
    public function __construct(
        public Companies $companies,
    )
    {
        $this->builder = $this->companies->newQuery();
    }
    /**
     * @param string $name
     * @return bool
     */
    public function isValidDomainName(string $name): bool
    {
        return !$this->builder->where('domain', $name)->exists();
    }

    /**
     * @param array $array
     * @return Builder|Model
     */
    public function store(array $array)
    {
        return $this->builder->create($array);
    }

    /**
     * @return Collection|array
     */
    public function getWaitingApproval(): Collection|array
    {
        return $this->builder
            ->with('documents')
            ->whereNull('domain')->get();
    }

    /**
     * @param int $id
     * @return Builder|Model
     */
    public function showWaitingApproval(int $id): Builder|Model
    {
        return $this->builder
            ->where('id', $id)
            ->with(['documents', 'officials', 'packages'])
            ->whereNull('domain')
            ->first();
    }

    /**
     * @param int $id
     * @param array $fill
     * @return int
     */
    public function update(int $id , array $fill): int
    {
        return $this->builder->where('id' , $id )->update($fill);
    }

    /**
     * @param int $id
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function find(int $id)
    {
        return $this->builder->find($id);
    }

    public function findWithPackageByDomain(string $domain)
    {
        return $this->builder->where('domain' , $domain)->with('packages')->first();
    }
    public function findByDomain(string $domain)
    {
        return $this->builder->where('domain' , $domain)->first();
    }
    public function findWithOfficials(int $id)
    {
        return $this->builder->with('officials')->find($id);
    }

    public function findWithRelations(int $id)
    {
        return $this->builder->with(['packages.packages', 'documents', 'officials'])->find($id);
    }

    /**
     * @param int $id
     * @return mixed
     * @description Turizm firmasını oluşturduğu Grup isimleri listesi
     */
    public function groupList(int $id)
    {
        return TourismCompanyGroup::where('users_id',$id)->get();
        //return $this->builder->find($id);
    }
}