<?php

namespace Rezyon\Applications\TourismCompanyUser;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {

    }
    public function register(): void
    {
        parent::register();
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
    }
}