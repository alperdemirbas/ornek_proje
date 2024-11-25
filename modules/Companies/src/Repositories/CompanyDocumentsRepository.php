<?php

namespace Rezyon\Companies\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Rezyon\Companies\Interfaces\CompanyDocumentsRepositoryInterface;
use Rezyon\Companies\Models\CompanyDocuments;

class CompanyDocumentsRepository implements CompanyDocumentsRepositoryInterface
{
    protected Builder $builder;
    public function __construct(
        public CompanyDocuments $companyDocuments
    ){
        $this->builder = $this->companyDocuments->newQuery();
    }

    public function store(array $array)
    {
        return $this->builder->create($array);
    }
}