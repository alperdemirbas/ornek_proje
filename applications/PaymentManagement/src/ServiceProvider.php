<?php

namespace Rezyon\Applications\PaymentManagement;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        parent::register();
        $this->loadViewsFrom(__DIR__ . '/../resources/views', "applications.payment.management");
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        $this->mergeConfigFrom(__DIR__ .'/../resources/config.php','payment');
    }

    public function boot()
    {
        
    }
}