<?php

namespace Rezyon\Applications\Users;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Rezyon\Applications\Users\Policies\UsersPolicies;
use Rezyon\Users\Models\Users;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        Users::class => UsersPolicies::class
    ];
    public function boot()
    {
        $this->registerPolicies();

    }
}