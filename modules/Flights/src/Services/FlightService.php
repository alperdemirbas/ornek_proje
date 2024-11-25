<?php

namespace Rezyon\Flights\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Rezyon\Flights\DataAccess\FlightRepository;
use Rezyon\Flights\Enums\FlightStatusEnums;
use Rezyon\Flights\Flight;

class FlightService
{
    protected FlightRepository $repository;

    public function __construct(FlightRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Flight $flight
     * @return Builder|Model
     */
    public function create(Flight $flight): Builder|Model
    {
        return $this
            ->repository
            ->create([
                'users_id' => $flight->getUser(),
                'flight_number' => $flight->getFlightNumber(),
                'detail' => $flight->getDetail(),
                'departure_time' => $flight->getDepartureTime(),
                'departure_airport' => $flight->getDepartureAirport(),
                'arrival_time' => $flight->getArrivalTime(),
                'arrival_airport' => $flight->getArrivalAirport(),
                'return' => $flight->getReturn(),
                'status' => $flight->getStatus(),
            ]);
    }

    /**
     * @param int $id
     * @param array $fields
     * @return int
     */
    public function update(int $id, array $fields): int
    {
        return $this->repository->update($id, $fields);
    }

    /**
     * @param int $id
     * @return Builder|Model
     */
    public function find(int $id): Builder|Model
    {
        return $this
            ->repository
            ->find($id);
    }

    /**
     * @param int $id
     * @return int
     */
    public function confirm(int $id): int
    {
        return $this->repository->confirm($id);
    }

    /**
     * @param int $id
     * @return int
     */
    public function return(int $id): int
    {
        return $this->repository->return($id);
    }

    /**
     * @param int $id
     * @return int
     */
    public function cancel(int $id): int
    {
        return $this->repository->cancel($id);
    }

}