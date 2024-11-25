<?php

namespace Rezyon\Supplier;

use Carbon\Carbon;

/**
 *
 */
class Session
{
    protected Carbon|null $start_time = null;
    protected Carbon|null $end_time = null;
    protected int $capacity = 0;
    protected array $days = [];

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

    public function getCapacity(): int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): void
    {
        $this->capacity = $capacity;
    }

    public function getDays(): array
    {
        return $this->days;
    }

    public function setDays(array $days): void
    {
        $this->days = $days;
    }

}