<?php

namespace Rezyon\Supplier\Repositories;

use Rezyon\Supplier\Models\Activity;
use Rezyon\Supplier\Models\ActivityPriceRule;

class ActivityPriceRuleRepository
{
    public function __construct(
        public ActivityPriceRule $activity
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