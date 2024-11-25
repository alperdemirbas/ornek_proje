<?php

namespace Rezyon\Applications\Users;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public function register()
    {
        parent::register();
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->mergeConfigFrom(__DIR__.'/../resources/config/permissions.php','permissions');
        $this->loadViewsFrom(__DIR__ . '/../resources/views',"applications.users");
        $this->app->register(AuthServiceProvider::class);
    }

    public function boot()
    {

    }
}