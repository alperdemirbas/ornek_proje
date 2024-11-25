<?php

namespace Rezyon\Supplier\Observers;

use Illuminate\Support\Facades\Auth;
use Rezyon\Supplier\Models\Activity;
use Rezyon\Supplier\Services\ActivityService;

class ActivityObserver
{
    public function __construct(
        public ActivityService $service
    )
    {
    }

    public function retrieved(Activity $activity)
    {
        if (Auth::guard('tourism-user-api')->hasUser()) {
            $lastView = $activity->views;
            $id = $activity->id;
            $this->service->viewIncreaseInObserver(
                $id,
                $lastView
            );
        }
    }
}
