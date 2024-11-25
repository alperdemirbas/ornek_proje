<?php

namespace Rezyon\Applications\Orders;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Rezyon\Applications\Packages\Policies\OrdersPolicy;
use Rezyon\Orders\Models\Orders;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        Orders::class => OrdersPolicy::class
    ];
    public function boot()
    {
        $this->registerPolicies();

    }
}