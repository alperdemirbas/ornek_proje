<?php

namespace Rezyon\Transfers;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {

    }
    public function register(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}