<?php

namespace Rezyon\Supplier\Repositories;

use Rezyon\Supplier\Models\ActivityParticipants;

class ActivityParticipantsRepository
{
    protected ActivityParticipants $repository;

    public function __construct(ActivityParticipants $repository)
    {
        $this->repository = $repository;
    }

    public function create(array $fields)
    {
        return $this->repository->newQuery()->create($fields);
    }
}