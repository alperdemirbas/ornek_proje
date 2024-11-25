<?php

namespace Rezyon\Carts;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        parent::register();
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    public function boot()
    {
        
    }
}