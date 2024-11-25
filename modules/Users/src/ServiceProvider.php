<?php

namespace Rezyon\Users;

use Illuminate\Support\ServiceProvider as CoreServiceProvider;
use Rezyon\Users\Interfaces\UserRepositoryInterface;
use Rezyon\Users\Repositories\UserRepository;

class ServiceProvider extends CoreServiceProvider
{
    public function register(): void
    {
        parent::register();
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);
    }

    public function boot()
    {

    }
}