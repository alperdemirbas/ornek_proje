<?php

namespace Rezyon\Flights\DataAccess;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Rezyon\Flights\Enums\FlightStatusEnums;
use Rezyon\Flights\Models\Flights;

class FlightRepository
{
    protected Flights $flights;
    protected Builder $query;

    public function __construct(Flights $flights)
    {
        $this->flights = $flights;
        $this->query = $flights->newQuery();
    }

    /**
     * @param array $flight
     * @return Model|Builder
     */
    public function create(array $flight): Model|Builder
    {
        return $this->query->create($flight);
    }

    /**
     * @param int $id
     * @param array $fields
     * @return int
     */
    public function update(int $id, array $fields): int
    {
        return $this->query->where('id', $id)->update($fields);
    }

    /**
     * @param int $id
     * @return Model|Builder
     */
    public function find(int $id): Model|Builder
    {
        return $this->query->find($id);
    }

    /**
     * @param int $id
     * @return int
     */
    public function confirm(int $id): int
    {
        return $this->query->where('id', $id)->update(['status' => FlightStatusEnums::LANDED]);
    }

    /**
     * @param int $id
     * @return int
     */
    public function return(int $id): int
    {
        return $this->query->where('id', $id)->update(['status' => FlightStatusEnums::RETURNED]);
    }

    /**
     * @param int $id
     * @return int
     */
    public function cancel(int $id): int
    {
        return $this->query->where('id', $id)->update(['status' => FlightStatusEnums::CANCELLED]);
    }
}