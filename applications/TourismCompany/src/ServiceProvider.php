<?php

namespace Rezyon\Applications\TourismCompany;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        parent::register();
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', "applications.tourism");
        $this->mergeConfigFrom(__DIR__.'/../resources/config/permissions.php','permissions');
        $this->app->register(AuthServiceProvider::class);
    }

    public function boot()
    {
        
    }
}