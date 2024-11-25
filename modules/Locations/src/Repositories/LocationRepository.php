<?php

namespace Rezyon\Locations\Repositories;

use Illuminate\Support\Facades\Cache;
use Rezyon\Locations\Models\ActivityAddress;
use Rezyon\Locations\Models\City;
use Rezyon\Locations\Models\District;
use Rezyon\Locations\Models\Neighborhood;
use Rezyon\Locations\Models\Street;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class LocationRepository
{
    protected ActivityAddress $model;
    public function __construct(
        public City         $city,
        public District     $district,
        public Neighborhood $neighborhood,
        public Street       $street,
        ActivityAddress $model
    )
    {
        $this->model = $model;
    }

    private function queryBuilder(){
        return QueryBuilder::for(City::class)
            ->allowedSorts(['city_name','id'])
            ->allowedFilters([
                AllowedFilter::scope('id'),
            ])
            ->allowedIncludes('district.neighborhood')
            ->get();
    }

    public function query(?string $cacheName=null)
    {
        if (empty($cacheName)){
            return $this->queryBuilder();
        }
        return Cache::rememberForever($cacheName,function (){
            return $this->queryBuilder();
        });

    }

    private function queryBuilderStreet(int $id){
        return QueryBuilder::for(Street::class)
            ->allowedSorts(['street_name','id'])
            ->where('neighborhood_id',$id)
            ->get();
    }

    public function streetList(int $id,?string $cacheName=null)
    {
        if (empty($cacheName)){
            return $this->queryBuilderStreet($id);
        }
        return Cache::rememberForever($cacheName,function () use ($id){
            return $this->queryBuilderStreet($id);
        });

    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

}