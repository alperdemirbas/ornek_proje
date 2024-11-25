<?php

namespace Rezyon\Locations;

class Location
{

    protected int $street;
    protected string $detail;
    protected ?string $directions = null;
    protected string $latitude;
    protected string $longitude;

    /**
     * @return int
     */
    public function getStreet(): int
    {
        return $this->street;
    }

    /**
     * @param int $street
     * @return Location
     */
    public function setStreet(int $street): Location
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @return string
     */
    public function getDetail(): string
    {
        return $this->detail;
    }

    /**
     * @param string $detail
     * @return Location
     */
    public function setDetail(string $detail): Location
    {
        $this->detail = $detail;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDirections(): ?string
    {
        return $this->directions;
    }

    /**
     * @param string|null $directions
     * @return Location
     */
    public function setDirections(?string $directions): Location
    {
        $this->directions = $directions;
        return $this;
    }

    /**
     * @return string
     */
    public function getLatitude(): string
    {
        return $this->latitude;
    }

    /**
     * @param string $latitude
     * @return Location
     */
    public function setLatitude(string $latitude): Location
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @return string
     */
    public function getLongitude(): string
    {
        return $this->longitude;
    }

    /**
     * @param string $longitude
     * @return Location
     */
    public function setLongitude(string $longitude): Location
    {
        $this->longitude = $longitude;
        return $this;
    }


}