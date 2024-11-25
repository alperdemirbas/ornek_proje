<?php

namespace Rezyon\Hotels;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Rezyon\Hotels\Entity\HotelsEntity;

class Hotel
{
    protected int $user;
    protected string $name;
    protected string $phone;
    protected string $phoneCountry;
    protected string $address;
    protected int $city;
    protected int $district;
    protected bool $status;
    protected HotelsEntity $entity;

    public function __construct(HotelsEntity $hotelsEntity)
    {
        $this->entity = $hotelsEntity;
    }

    /**
     * @return int
     */
    public function getUser(): int
    {
        return $this->user;
    }

    /**
     * @param int $user
     * @return Hotel
     */
    public function setUser(int $user): Hotel
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Hotel
     */
    public function setName(string $name): Hotel
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return Hotel
     */
    public function setPhone(string$phone): Hotel
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhoneCountry(): string
    {
        return $this->phoneCountry;
    }

    /**
     * @param string $phoneCountry
     * @return Hotel
     */
    public function setPhoneCountry(string $phoneCountry): Hotel
    {
        $this->phoneCountry = $phoneCountry;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Hotel
     */
    public function setAddress(string $address): Hotel
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return int
     */
    public function getCity(): int
    {
        return $this->city;
    }

    /**
     * @param int $city
     * @return Hotel
     */
    public function setCity(int $city): Hotel
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return int
     */
    public function getDistrict(): int
    {
        return $this->district;
    }

    /**
     * @param int $district
     * @return Hotel
     */
    public function setDistrict(int $district): Hotel
    {
        $this->district = $district;
        return $this;
    }

    /**
     * @return bool
     */
    public function isStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     * @return Hotel
     */
    public function setStatus(bool $status): Hotel
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return Builder|Model
     */
    public function save(): Model|Builder
    {
        return $this->entity->create($this);
    }
}
