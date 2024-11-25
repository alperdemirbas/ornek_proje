<?php

namespace Rezyon\Applications\Hotels;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Rezyon\Applications\Hotels\Policies\HotelsPolicy;
use Rezyon\Companies\Models\Users;
use Rezyon\Hotels\Models\Hotel;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        Hotel::class => HotelsPolicy::class,
        Users::class => HotelsPolicy::class,
        \Rezyon\Users\Models\Users::class => HotelsPolicy::class,
        \Rezyon\TourismCompanyUser\Models\Users::class => HotelsPolicy::class,
    ];
    public function boot()
    {
        $this->registerPolicies();
    }
}