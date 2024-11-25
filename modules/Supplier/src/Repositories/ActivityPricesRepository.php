<?php

namespace Rezyon\Supplier\Repositories;

use Rezyon\Supplier\Models\ActivityPrice;

class ActivityPricesRepository
{
    public function __construct(
        public ActivityPrice $activity
    )
    {

    }

    public function store(array $data)
    {
        return $this->activity->newQuery()->create($data);
    }

    public function list(int $id)
    {
        return $this->activity->newQuery()->where('activity_id', $id)->get();
    }
}