<?php

namespace Rezyon\Flights;

use Illuminate\Support\Facades\Log;
use Rezyon\Flights\Interfaces\FlightInterface;
use Rezyon\Flights\Interfaces\FlightServiceInterface;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    public function boot()
    {

    }
}