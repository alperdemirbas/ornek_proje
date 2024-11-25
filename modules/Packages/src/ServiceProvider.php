<?php

namespace Rezyon\Packages;
use \Illuminate\Support\ServiceProvider as CoreServiceProvider;
use Rezyon\Packages\Interfaces\PackagesInterface;
use Rezyon\Packages\Interfaces\PackagesRepositoryInterface;
use Rezyon\Packages\Interfaces\PackagesServiceInterface;
use Rezyon\Packages\Repositories\PackagesRepository;

class ServiceProvider extends CoreServiceProvider
{
    public function register(): void
    {
        parent::register();
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->app->singleton(PackagesServiceInterface::class,PackagesService::class);
        $this->app->singleton(PackagesRepositoryInterface::class, PackagesRepository::class);
        $this->app->singleton(PackagesInterface::class,Packages::class);
    }

    public function boot()
    {

    }
}