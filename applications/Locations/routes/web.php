<?php

use Illuminate\Support\Facades\Route;
use Rezyon\Applications\Locations\Http\Controllers\LocationController;

Route::group(['prefix' => 'locations', 'middleware' => ['web']]
    , function () {
        Route::get('/', [LocationController::class, 'index']);
        Route::get('{neighborhood_id}/street',[LocationController::class,'streetList']);
    }
);
