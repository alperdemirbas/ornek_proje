<?php

namespace Rezyon\Applications\TourismCompany;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Rezyon\Applications\TourismCompany\Policies\TourismCompanyPolicy;
use Rezyon\TourismCompany\Models\TourismCompanyActivity;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        TourismCompanyActivity::class => TourismCompanyPolicy::class
    ];
    public function boot()
    {
        $this->registerPolicies();

    }
}