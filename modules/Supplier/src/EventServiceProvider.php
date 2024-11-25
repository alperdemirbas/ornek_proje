<?php

namespace Rezyon\Supplier;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Rezyon\Supplier\Observers\ActivityObserver;

class EventServiceProvider extends ServiceProvider
{

    protected $listen = [

    ];

    protected $observers = [
        \Rezyon\Supplier\Models\Activity::class => [ActivityObserver::class],
    ];

}