<?php

namespace Rezyon\Supplier;

use Database\Seeders\DatabaseSeeder;
use Rezyon\Supplier\Database\Seeds\ActivityCategorySeeder;
use Rezyon\Supplier\Database\Seeds\ActivityCategoryTypeSeeder;
use Rezyon\Supplier\Observers\ActivityObserver;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->app->register(EventServiceProvider::class);

    }

    public function boot()
    {
        $seedList = [
            ActivityCategoryTypeSeeder::class,
            ActivityCategorySeeder::class,
        ];
        $this->callAfterResolving(DatabaseSeeder::class, function ($seeder) use ($seedList) {
            foreach ($seedList as $path) {
                $seeder->call($seedList);
            }
        });



    }
}