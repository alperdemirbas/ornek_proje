<?php

namespace Rezyon\Companies\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Rezyon\Companies\Interfaces\CompanyOfficialsRepositoryInterface;
use Rezyon\Companies\Models\CompanyOfficials;

class CompanyOfficialsRepository implements CompanyOfficialsRepositoryInterface
{
    protected Builder $builder;
    public function __construct(
        public CompanyOfficials $companyDocuments
    ){
        $this->builder = $this->companyDocuments->newQuery();
    }

    public function store(array $array)
    {
        return $this->builder->create($array);
    }

    /**
     * @param int $id
     * @param array $fill
     * @return int
     */
    public function updateFromCompany(int $id, array $fill): int
    {
        return $this->builder->where('companies_id', $id)->update($fill);
    }

    /**
     * @description Firma yetkilisi güncelle
     * @param int $id
     * @param array $fill
     * @return int
     */
    public function update(int $id, array $fill): int
    {
        return $this->builder->where('id', $id)->update($fill);
    }


    /*
     * Yetkili Sil
     */
    public function destroy(int $id): void
    {
        $this->builder->where('id', $id)->delete();
    }

    /**
     * @description Yetkili ID'si ile bul
     * @param int $id
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function find(int $id)
    {
        return $this->builder->find($id);
    }
}