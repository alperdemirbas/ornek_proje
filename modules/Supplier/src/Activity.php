<?php

namespace Rezyon\Supplier;

use Carbon\Carbon;
use Rezyon\Supplier\Enums\PriceCurrency;

/**
 *
 */
class Activity
{

    protected array $name = [];
    protected int $companiesId;
    protected array $description;
    protected Carbon|null $start_time = null;
    protected Carbon|null $end_time = null;
    protected int $duration = 0;
    protected int $activityID;
    protected PriceCurrency $currency;

    public function getCompaniesId(): int
    {
        return $this->companiesId;
    }

    public function setCompaniesId(int $companiesId): void
    {
        $this->companiesId = $companiesId;
    }

    public function getCurrency(): PriceCurrency
    {
        return $this->currency;
    }

    public function setCurrency(PriceCurrency $currency): void
    {
        $this->currency = $currency;
    }

    public function getActivityID(): int
    {
        return $this->activityID;
    }

    public function setActivityID(int $activityID): void
    {
        $this->activityID = $activityID;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): void
    {
        $this->duration = $duration;
    }

    /**
     * @return string
     */
    public function getName(): array
    {
        return $this->name;
    }

    /**
     * @param array $name
     * @return void
     */
    public function setName(array $name): void
    {
        $this->name = $name;
    }

    public function getStartTime(): ?Carbon
    {
        return $this->start_time;
    }

    public function setStartTime(?Carbon $start_time): void
    {
        $this->start_time = $start_time;
    }

    public function getEndTime(): ?Carbon
    {
        return $this->end_time;
    }

    public function setEndTime(?Carbon $end_time): void
    {
        $this->end_time = $end_time;
    }

    /**
     * @return array
     */
    public function getDescription(): array
    {
        return $this->description;
    }

    /**
     * @param array $description
     * @return void
     */
    public function setDescription(array $description): void
    {
        $this->description = $description;
    }


}