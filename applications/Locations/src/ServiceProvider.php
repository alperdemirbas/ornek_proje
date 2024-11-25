<?php

namespace Rezyon\Applications\Locations;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }

    public function boot(){

    }
}