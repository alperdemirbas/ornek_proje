<?php

namespace Rezyon\Applications\Supplier;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Rezyon\Applications\Supplier\Policies\SupplierPolicy;
use Rezyon\Supplier\Models\Activity;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        Activity::class => SupplierPolicy::class
    ];
    public function boot()
    {
        $this->registerPolicies();

    }
}