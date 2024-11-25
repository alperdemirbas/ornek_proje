<?php

namespace Rezyon\Locations;

use Database\Seeders\DatabaseSeeder;
use Rezyon\Locations\Databases\Seeds\CitySeeder;
use Rezyon\Locations\Databases\Seeds\DistrictSeeder;
use Rezyon\Locations\Databases\Seeds\NeighborhoodSeeder;
use Rezyon\Locations\Databases\Seeds\StreetSeeder;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        parent::register();
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    public function boot()
    {
        $seedList = [
//            CitySeeder::class,
//            DistrictSeeder::class,
//            NeighborhoodSeeder::class,
//            StreetSeeder::class,
        ];
        $this->callAfterResolving(DatabaseSeeder::class, function ($seeder) use  ($seedList){
            $seeder->call($seedList);
        });
    }
}