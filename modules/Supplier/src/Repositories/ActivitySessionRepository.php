<?php

namespace Rezyon\Supplier\Repositories;

use Rezyon\Supplier\Models\ActivitySession;

class ActivitySessionRepository
{
    public function __construct(
        public ActivitySession $activity
    )
    {

    }

    public function store(array $data)
    {
        return $this->activity->newQuery()->create($data);
    }

    public function getActivitySessions(int $activityId)
    {
        return $this->activity->newQuery()->where('activity_id', $activityId)->get();
    }
}