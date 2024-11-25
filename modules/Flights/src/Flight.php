<?php

namespace Rezyon\Flights;

use Rezyon\Flights\Enums\FlightStatusEnums;

class Flight
{
    protected int $user;
    protected string $flightNumber;
    protected ?string $detail = null;
    protected string $departureTime;
    protected string $departureAirport;
    protected string $arrivalTime;
    protected string $arrivalAirport;
    protected string $return;
    protected FlightStatusEnums $status;

    /**
     * @return int
     */
    public function getUser(): int
    {
        return $this->user;
    }

    /**
     * @param int $user
     */
    public function setUser(int $user): void
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getFlightNumber(): string
    {
        return $this->flightNumber;
    }

    /**
     * @param string $flightNumber
     */
    public function setFlightNumber(string $flightNumber): void
    {
        $this->flightNumber = $flightNumber;
    }

    /**
     * @return string|null
     */
    public function getDetail(): ?string
    {
        return $this->detail;
    }

    /**
     * @param string|null $detail
     */
    public function setDetail(?string $detail): void
    {
        $this->detail = $detail;
    }

    /**
     * @return string
     */
    public function getDepartureTime(): string
    {
        return $this->departureTime;
    }

    /**
     * @param string $departureTime
     */
    public function setDepartureTime(string $departureTime): void
    {
        $this->departureTime = $departureTime;
    }

    /**
     * @return string
     */
    public function getDepartureAirport(): string
    {
        return $this->departureAirport;
    }

    /**
     * @param string $departureAirport
     */
    public function setDepartureAirport(string $departureAirport): void
    {
        $this->departureAirport = $departureAirport;
    }

    /**
     * @return string
     */
    public function getArrivalTime(): string
    {
        return $this->arrivalTime;
    }

    /**
     * @param string $arrivalTime
     */
    public function setArrivalTime(string $arrivalTime): void
    {
        $this->arrivalTime = $arrivalTime;
    }

    /**
     * @return string
     */
    public function getArrivalAirport(): string
    {
        return $this->arrivalAirport;
    }

    /**
     * @param string $arrivalAirport
     */
    public function setArrivalAirport(string $arrivalAirport): void
    {
        $this->arrivalAirport = $arrivalAirport;
    }

    /**
     * @return string
     */
    public function getReturn(): string
    {
        return $this->return;
    }

    /**
     * @param string $return
     */
    public function setReturn(string $return): void
    {
        $this->return = $return;
    }

    /**
     * @return FlightStatusEnums
     */
    public function getStatus(): FlightStatusEnums
    {
        return $this->status;
    }

    /**
     * @param FlightStatusEnums $status
     */
    public function setStatus(FlightStatusEnums $status): void
    {
        $this->status = $status;
    }
}