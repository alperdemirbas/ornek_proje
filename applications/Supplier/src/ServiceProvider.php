<?php

namespace Rezyon\Applications\Supplier;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        parent::register();
        $this->loadViewsFrom(__DIR__ . '/../resources/views', "applications.supplier");
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->mergeConfigFrom(__DIR__.'/../resources/config/permissions.php','permissions');
        $this->app->register(AuthServiceProvider::class);
    }

    public function boot()
    {

    }
}