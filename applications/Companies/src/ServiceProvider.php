<?php

namespace Rezyon\Applications\Companies;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public function register()
    {
        parent::register();
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        app()->config["filesystems.disks.company"] = [
            'driver' => 'local',
            'root' => storage_path('app/public/customer'),
            'url' => env('APP_URL').'/storage/customer',
            'visibility' => 'public',
            'throw' => false,
        ];
        $this->mergeConfigFrom(__DIR__.'/../resources/config/permissions.php','permissions');
        $this->loadViewsFrom(__DIR__ . '/../resources/views',"applications.companies");

        $this->app->register(AuthServiceProvider::class);
    }

    public function boot()
    {

    }
}