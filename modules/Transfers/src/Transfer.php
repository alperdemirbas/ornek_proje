<?php

namespace Rezyon\Transfers;

class Transfer
{
    protected int $userId;
    protected int $activityId;
    protected int $hotelId;
    protected ?int $sessionId = null;
    protected int $carId;
    protected string $date;
    protected string $time;
    protected string $driverName;
    protected string $driverPhone;
    protected string $driverPhoneCountry;

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getActivityId(): int
    {
        return $this->activityId;
    }

    /**
     * @param int $activityId
     */
    public function setActivityId(int $activityId): void
    {
        $this->activityId = $activityId;
    }

    /**
     * @return int
     */
    public function getHotelId(): int
    {
        return $this->hotelId;
    }

    /**
     * @param int $hotelId
     */
    public function setHotelId(int $hotelId): void
    {
        $this->hotelId = $hotelId;
    }

    /**
     * @return int|null
     */
    public function getSessionId(): ?int
    {
        return $this->sessionId;
    }

    /**
     * @param int|null $sessionId
     */
    public function setSessionId(?int $sessionId): void
    {
        $this->sessionId = $sessionId;
    }

    /**
     * @return int
     */
    public function getCarId(): int
    {
        return $this->carId;
    }

    /**
     * @param int $carId
     */
    public function setCarId(int $carId): void
    {
        $this->carId = $carId;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getTime(): string
    {
        return $this->time;
    }

    /**
     * @param string $time
     */
    public function setTime(string $time): void
    {
        $this->time = $time;
    }

    /**
     * @return string
     */
    public function getDriverName(): string
    {
        return $this->driverName;
    }

    /**
     * @param string $driverName
     */
    public function setDriverName(string $driverName): void
    {
        $this->driverName = $driverName;
    }

    /**
     * @return string
     */
    public function getDriverPhone(): string
    {
        return $this->driverPhone;
    }

    /**
     * @param string $driverPhone
     */
    public function setDriverPhone(string $driverPhone): void
    {
        $this->driverPhone = $driverPhone;
    }

    /**
     * @return string
     */
    public function getDriverPhoneCountry(): string
    {
        return $this->driverPhoneCountry;
    }

    /**
     * @param string $driverPhoneCountry
     */
    public function setDriverPhoneCountry(string $driverPhoneCountry): void
    {
        $this->driverPhoneCountry = $driverPhoneCountry;
    }
}