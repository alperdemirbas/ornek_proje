<?php

namespace Rezyon\Companies;

use Rezyon\Companies\Database\Seeders\CompanySeeder;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\RolesAndPermissionsSeeder;
use Rezyon\Companies\Console\Commands\CheckPaymentDate;
use Rezyon\Companies\Interfaces\CompaniesRepositoryInterface;
use Rezyon\Companies\Interfaces\CompaniesServiceInterface;
use Rezyon\Companies\Interfaces\CompanyDocumentsRepositoryInterface;
use Rezyon\Companies\Interfaces\CompanyFilesInterface;
use Rezyon\Companies\Interfaces\CompanyInterface;
use Rezyon\Companies\Interfaces\CompanyOfficialsInterface;
use Rezyon\Companies\Interfaces\CompanyOfficialsRepositoryInterface;
use Rezyon\Companies\Interfaces\CompanyPackageInterface;
use Rezyon\Companies\Interfaces\CompanyPackageServiceInterface;
use Rezyon\Companies\Interfaces\CompanyPackagesRepositoryInterface;
use Rezyon\Companies\Interfaces\UserInfoRepositoryInterface;
use Rezyon\Companies\Repositories\CompaniesRepository;
use Rezyon\Companies\Repositories\CompanyDocumentsRepository;
use Rezyon\Companies\Repositories\CompanyOfficialsRepository;
use Rezyon\Companies\Repositories\CompanyPackagesRepository;
use Rezyon\Companies\Repositories\UserInfoRepository;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register(): void
    {
        parent::register();
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->commands([
            CheckPaymentDate::class
        ]);
        ### SERVICES
        $this->app->singleton(CompaniesServiceInterface::class, CompaniesService::class);
        $this->app->singleton(CompanyPackageServiceInterface::class,CompanyPackageService::class);

        $this->app->singleton(CompanyInterface::class, Company::class);
        $this->app->singleton(CompanyFilesInterface::class, CompanyFiles::class);
        $this->app->singleton(CompanyOfficialsInterface::class, CompanyOfficials::class);
        $this->app->singleton(CompanyPackageInterface::class, CompanyPackage::class);

        ### REPOSITORIES
        $this->app->singleton(CompaniesRepositoryInterface::class, CompaniesRepository::class);
        $this->app->singleton(CompanyDocumentsRepositoryInterface::class, CompanyDocumentsRepository::class);
        $this->app->singleton(CompanyOfficialsRepositoryInterface::class, CompanyOfficialsRepository::class);
        $this->app->singleton(CompanyPackagesRepositoryInterface::class, CompanyPackagesRepository::class);
        $this->app->singleton(UserInfoRepositoryInterface::class,UserInfoRepository::class);

    }

    public function boot()
    {
        $seedList = [
            RolesAndPermissionsSeeder::class,
            CompanySeeder::class,
        ];
        $this->callAfterResolving(DatabaseSeeder::class, function ($seeder) use ($seedList) {
            foreach ($seedList as $path) {
                $seeder->call($seedList);
            }
        });
    }

}