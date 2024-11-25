<?php
namespace  Rezyon\Applications\Flights;

use Illuminate\Support\ServiceProvider as CoreServiceProvider;
use Rezyon\Applications\Flights\DataAccess\CompanyFlightsDataAccess;
use Rezyon\Applications\Flights\DataAccess\FlightCustomersDataAccess;
use Rezyon\Applications\Flights\Interfaces\CompanyFlightsDataAccessInterface;
use Rezyon\Applications\Flights\Interfaces\FlightCustomersDataAccessInterface;
use Rezyon\Applications\Flights\Interfaces\UserFlightsInterface;
use Rezyon\Applications\Flights\Interfaces\UserFlightsServiceInterface;

class ServiceProvider extends CoreServiceProvider
{
    public function register()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views',"applications.flights");
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->app->bind(UserFlightsServiceInterface::class, UserFlightsService::class);
        $this->app->bind(UserFlightsInterface::class, UserFlights::class);
        $this->app->bind(CompanyFlightsDataAccessInterface::class, CompanyFlightsDataAccess::class);
        $this->app->bind(FlightCustomersDataAccessInterface::class, FlightCustomersDataAccess::class);
    }

    public function boot()
    {

    }
}