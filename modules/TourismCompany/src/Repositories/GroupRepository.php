<?php

namespace Rezyon\TourismCompany\Repositories;

use Rezyon\TourismCompany\Models\TourismCompanyGroup;

class GroupRepository
{
    public function __construct(
        public TourismCompanyGroup $activity
    )
    {

    }
    public function update(int $groupId ,  array $data){
        $query = $this->activity->where('id', $groupId);
        if(!empty($data['users_id'])){
            $query->where('users_id', $data['users_id']);
        }
        $query->update( $data );
    }
    public function store(array $data)
    {
        return $this->activity->newQuery()->attach($data);
    }
}