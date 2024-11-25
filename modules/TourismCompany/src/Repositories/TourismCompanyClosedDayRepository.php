<?php

namespace Rezyon\TourismCompany\Repositories;

use Rezyon\TourismCompany\Models\TourismCompanyActivityClosedDay;

class TourismCompanyClosedDayRepository
{
    public function __construct(
        public TourismCompanyActivityClosedDay $closedDay
    )
    {

    }

    public function create(array $data )
    {
        return $this->closedDay->newQuery()->create( $data );
    }

    public function delete(int $id)
    {
        return $this->closedDay->find($id)->delete();
    }

}