<?php

namespace Rezyon\Supplier\Repositories;

use Rezyon\Supplier\Models\ActivityPhoto;

class ActivityPhotosRepository
{
    public function __construct(
        public ActivityPhoto $activity
    )
    {

    }

    public function store(array $data)
    {
        return $this->activity->newQuery()->create($data);
    }
}