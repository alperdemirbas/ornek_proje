<?php

namespace Rezyon\Applications\Packages;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Rezyon\Applications\Packages\Policies\PackagesPolicy;
use Rezyon\Packages\Models\Packages;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        Packages::class => PackagesPolicy::class
    ];
    public function boot()
    {
        $this->registerPolicies();

    }
}