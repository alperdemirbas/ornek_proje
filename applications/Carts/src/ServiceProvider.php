<?php

namespace Rezyon\Applications\Carts;

use Illuminate\Contracts\Debug\ExceptionHandler as ExceptionHandlerContract;
use Rezyon\Applications\Carts\Exceptions\Handler;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public function register()
    {
        parent::register();
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->app->singleton(ExceptionHandlerContract::class, Handler::class);
    }

    public function boot()
    {

    }
}