<?php

namespace Rezyon\Paytr;
use Rezyon\Paytr\Client\Client;
use Rezyon\Paytr\Interfaces\ClientInterface;
use Rezyon\Paytr\Interfaces\PaytrInterface;

class ServiceProvider extends  \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'paytr');
        $this->publishes([__DIR__ . '/../config/config.php'  => config_path('paytr.php')],'paytr');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->app->bind(PaytrInterface::class, Paytr::class);

        $this->app->singleton(ClientInterface::class, function(){
            $config = [
                'base_url' => Definitions::URL
            ];
            return new Client($config);
        });
    }

    public function boot()
    {

    }
}
