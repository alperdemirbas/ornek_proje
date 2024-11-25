<?php

use Illuminate\Support\Facades\Route;
use Rezyon\Applications\Transfers\Http\Controllers\{CarsController, TransfersController};

Route::domain('{subdomain}.' . env('APP_URL'))
    ->middleware('web')
    ->group(function () {
        Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth:companies']], function () {
            Route::resource('cars', CarsController::class)->except('show');
            Route::resource('transfers', TransfersController::class);
            Route::post('transfers/assign-user', [TransfersController::class, 'assignUser'])->name('applications.transfers::assign-user');
            Route::post('transfers/remove-user', [TransfersController::class, 'removeUser'])->name('applications.transfers::remove-user');
            Route::group(['prefix' => 'transfers/datatables'], function () {
               Route::get('users/{transfer}', [TransfersController::class, 'datatablesUsers'])->name('datatables.transfers.users');
               Route::get('customers/{transfer}', [TransfersController::class, 'datatablesCustomers'])->name('datatables.transfers.customers');
            });
        });
    });