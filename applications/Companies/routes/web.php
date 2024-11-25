<?php

use Illuminate\Support\Facades\Route;
use Rezyon\Applications\Companies\Http\Controllers\AuthController;
use Rezyon\Applications\Companies\Http\Controllers\CompaniesController;
use Rezyon\Applications\Companies\Http\Controllers\CompanyUsersController;
use Rezyon\Applications\Companies\Http\Controllers\DashboardController;
use Rezyon\Applications\Companies\Http\Controllers\CompanyOfficialsController;
use Rezyon\Applications\Companies\Http\Controllers\DomainController;


Route::post('deneme-talep-et', [CompaniesController::class, 'demo'])->name('companies.register.request');

Route::group(['prefix' => 'yonetim/firmalar','middleware'=>['web','auth']], function () {
    Route::post('onay', [CompaniesController::class, 'approve'])->name('appliaction.companies::confirm');
    Route::get('onay-bekleyenler', [CompaniesController::class, 'getWaitingApproval'])->name('application.companies::getWaitingApproval');
    Route::get('onay-bekleyenler/{id}', [CompaniesController::class, 'show'])->name('application.companies::show');
    Route::get('onay-bekleyenler/{id}/edit', [CompaniesController::class, 'edit'])->name('application.companies::edit');
    Route::post('onay-bekleyenler/{id}', [CompaniesController::class, 'waitingCompanyUpdate'])->name('application.companies::companyWaitingUpdate');
    Route::post('{id}/kullanici-ekle',[CompaniesController::class,'attachUser']);

    Route::get('/', [CompaniesController::class, 'viewList'])->name('companies.all');
    Route::get('{id}', [CompaniesController::class, 'showCompany'])->name('companies.show');
    Route::get('{id}/duzenle', [CompaniesController::class, 'editCompany'])->name('companies.edit');
    Route::post('/domain/kontrol',[CompaniesController::class,'checkDomain'])->name('companies.domain.check');
    Route::get('/{id}', [CompaniesController::class, 'showCompany'])->name('companies.show');
    Route::get('/{id}/duzenle', [CompaniesController::class, 'editCompany'])->name('companies.edit');
    Route::post('/{id}/duzenle', [CompaniesController::class, 'updateCompany'])->name('companies.update');

    // Firmalara bağlı yetkililer
    Route::group(['prefix' => 'yetkili', 'middleware' => 'web'], function () {
        Route::post('{id}/ekle',[CompanyOfficialsController::class,'store'])->name('applications.companies.official.store');
        Route::get('{id}/edit', [CompanyOfficialsController::class, 'edit'])->name('applications.companies.official.edit');
        Route::post('{id}/update', [CompanyOfficialsController::class, 'update'])->name('applications.companies.official.update');
        Route::post('destroy', [CompanyOfficialsController::class, 'destroy'])->name('applications.companies.official.destroy');
    });


    Route::post('/domain/kontrol',[CompaniesController::class,'checkDomain'])->name('companies.domain.check');


    Route::group(['prefix'=>'domainler','middleware' => 'web'],function(){
        Route::get('list', [DomainController::class, 'viewList'])->name('domains.view.list');
    });

    Route::group(['prefix'=>'datatables'],function(){
        Route::get('domain', [DomainController::class,'datatablesList'])->name('datatables.domain.list');
        Route::get('firmalar', [CompaniesController::class,'datatablesList'])->name('datatables.companies.list');
        Route::get('firmalar/paketler', [CompaniesController::class, 'packagesDataTable'])->name('datatables.companies.packages');
        Route::get('firmalar/kullanicilar', [CompaniesController::class, 'usersDataTable'])->name('datatables.companies.users');
        Route::get('firmalar/yetkililer', [CompaniesController::class, 'officialsDataTable'])->name('datatables.companies.officials');
        Route::get('firmalar/musteriler', [CompaniesController::class, 'customersDataTable'])->name('datatables.companies.customers');
        Route::get('firmalar/aktivite-havuzu', [CompaniesController::class, 'activityPoolDataTable'])->name('datatables.companies.activity.pool');
        Route::get('firmalar/aktiviteler', [CompaniesController::class, 'activitiesDataTable'])->name('datatables.companies.activities');
        Route::get('firmalar/tedarikci-musterileri', [CompaniesController::class, 'companySupplierCustomersDataTable'])->name('datatables.companies.supplier.customers');
    });

    Route::group(['prefix'=>'datatables'],function() {
        Route::get('domain', [DomainController::class, 'datatablesList'])->name('datatables.domain.list');
        Route::get('firmalar', [CompaniesController::class, 'datatablesList'])->name('datatables.companies.list');
        Route::get('/{id}/yetkililer', [CompanyOfficialsController::class, 'datatablesList'])->name('datatables.companies.officials.list');
    });

});

Route::domain('{subdomain}.' . env('APP_URL'))
    ->middleware('web')
    ->group(function () {
        Route::get('/yonetim/giris-yap', [AuthController::class, 'viewLogin'])->name('companies.view.login');
        Route::post('/yonetim/giris-yap', [AuthController::class, 'login'])->name('companies.login');
        Route::post('/yonetim/cikis-yap',[AuthController::class, 'logout'])->name('companies.logout');
        Route::group(['prefix' => 'yonetim','middleware'=>['web','auth:companies']], function () {
            Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');
        });
    });

Route::domain('{subdomain}.' . env('APP_URL'))
    ->middleware('web')
    ->group(function () {
        Route::group(['prefix' => 'yonetim/kullanicilar', 'middleware' => ['web', 'auth:companies']], function () {
            Route::get('ekle', [CompanyUsersController::class, 'add'])->name('company.users.add');
            Route::post('store', [CompanyUsersController::class, 'store'])->name('company.users.store');
            Route::get('duzenle/{user}', [CompanyUsersController::class, 'edit'])->name('company.users.edit');
            Route::post('update/{user}', [CompanyUsersController::class, 'update'])->name('company.users.update');
        });
    });

Route::domain('{subdomain}.' . env('APP_URL'))
    ->middleware('web')
    ->group(function () {
        Route::group(['prefix' => 'yonetim/musteriler', 'middleware' => ['web', 'auth:companies']], function () {
            Route::get('listele', [CompanyUsersController::class, 'customerViewList'])->name('company.customer.viewList');
            Route::get('ekle', [CompanyUsersController::class, 'customerViewAdd'])->name('company.customer.viewAdd');
            Route::post('store', [CompanyUsersController::class, 'customerStore'])->name('company.customer.store');
            Route::get('duzenle', [CompanyUsersController::class, 'customerViewEdit'])->name('company.customer.viewEdit');
        });
    });