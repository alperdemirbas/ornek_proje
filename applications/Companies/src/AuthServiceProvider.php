<?php

namespace Rezyon\Applications\Companies;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Rezyon\Applications\Companies\Policies\CompaniesOfficialsPolicy;
use Rezyon\Applications\Companies\Policies\CompaniesPolicy;
use Rezyon\Companies\Models\Companies;
use Rezyon\Companies\Models\CompanyOfficials;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        Companies::class => CompaniesPolicy::class,
        CompanyOfficials::class => CompaniesOfficialsPolicy::class,
    ];
    public function boot()
    {
        $this->registerPolicies();
    }
}