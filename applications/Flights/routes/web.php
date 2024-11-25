<?php

use App\Definitions;
use Illuminate\Support\Facades\Route;
use Rezyon\Applications\Flights\Http\Controllers\FlightsController;

Route::domain('{subdomain}.' . env('APP_URL'))
    ->middleware(['web', 'auth:companies'])
    ->group(function () {
        Route::group(['prefix' => Definitions::PANEL], function () {
            Route::resource('flights', FlightsController::class);
            Route::post('flights/{flight}/statusAction', [FlightsController::class, 'statusAction'])->name('flights.statusAction');
            Route::post('flights/getRow', [FlightsController::class, 'getRow'])->name('flights.getRow');
            Route::post('flights/changeStatus', [FlightsController::class, 'changeStatus'])->name('flights.changeStatus');
            Route::post('flights/{flight}/addCustomer', [FlightsController::class, 'addCustomer'])->name('flights.addCustomer');
            Route::post('flights/{flight}/transferCustomer', [FlightsController::class, 'transferCustomer'])->name('flights.transferCustomer');
        });
    });
