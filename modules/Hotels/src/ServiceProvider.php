<?php

namespace Rezyon\Hotels;

use Database\Seeders\DatabaseSeeder;
use Rezyon\Hotels\Database\Seeders\HotelSeeder;

class ServiceProvider extends  \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    public function boot()
    {
        $seedList = [
            HotelSeeder::class,
        ];
        $this->callAfterResolving(DatabaseSeeder::class, function ($seeder) use ($seedList) {
            foreach ($seedList as $path) {
                $seeder->call($seedList);
            }
        });
    }
}
