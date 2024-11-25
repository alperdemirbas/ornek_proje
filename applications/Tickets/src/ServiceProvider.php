<?php

namespace Rezyon\Applications\Tickets;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        parent::register();
        $this->loadViewsFrom(__DIR__ . '/../resources/views', "applications.tickets");
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }

    public function boot()
    {

    }
}