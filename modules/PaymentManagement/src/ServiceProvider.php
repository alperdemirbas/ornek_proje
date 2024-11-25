<?php
namespace Rezyon\PaymentManagement;
use Illuminate\Support\ServiceProvider as CoreServiceProvider;
use Rezyon\PaymentManagement\Services\Paytr\Client\Client;
use Rezyon\PaymentManagement\Services\Paytr\Interfaces\ClientInterface;

class ServiceProvider extends CoreServiceProvider
{
    public function register():void
    {
        parent::register();
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->app->singleton(ClientInterface::class, function(){
            $config = [
                'base_url' => "https://paytr.com"
            ];
            return new Client($config);
        });
    }

    public function boot()
    {

    }
}
