<?php

use Illuminate\Support\Facades\Route;
use Rezyon\Applications\Tickets\Http\Controllers\TicketsController;

Route::domain('{subdomain}.' . env('APP_URL'))
    ->middleware('web')
    ->group(function () {
        Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth:companies']], function () {
            Route::get('tickets/read', [TicketsController::class, 'index']);
            Route::post('tickets/read', [TicketsController::class, 'read'])->name('tickets.read');
        });
    });