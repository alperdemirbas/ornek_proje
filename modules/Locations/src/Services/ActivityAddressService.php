<?php

namespace Rezyon\Locations\Services;

use Rezyon\Locations\Location;
use Rezyon\Locations\Repositories\LocationRepository;
use Rezyon\Supplier\Models\Activity;

class ActivityAddressService
{
    protected LocationRepository $repository;
    public function __construct(LocationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(Activity $activity, Location $location)
    {
        return $this->repository->create([
            'activity_id' => $activity->id,
            'street_id'=> $location->getStreet(),
            'detail'=> $location->getDetail(),
            'directions'=> $location->getDirections(),
            'latitude'=> $location->getLatitude(),
            'longitude'=> $location->getLongitude(),
        ]);
    }
}