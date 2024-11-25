<?php

namespace Rezyon\Applications\Hotels;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\ServiceProvider as CoreServiceProvider;

class ServiceProvider extends CoreServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'applications.hotels');
        $this->mergeConfigFrom(__DIR__.'/../resources/config/permissions.php','permissions');
        $this->app->register(AuthServiceProvider::class);
    }

    public function boot()
    {

    }
}
