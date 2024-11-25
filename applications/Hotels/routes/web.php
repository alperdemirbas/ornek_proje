<?php


use Illuminate\Support\Facades\Route;
use Rezyon\Applications\Hotels\Http\Controllers\HotelAssignmentController;
use Rezyon\Applications\Hotels\Http\Controllers\HotelsController;

Route::group(['prefix'=>'admin', 'middleware' => 'web'], function(){
    Route::resource('hotels', HotelsController::class);
});

Route::domain('{subdomain}.' . env('APP_URL'))
    ->middleware('web')
    ->group(function () {
        Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth:companies']], function () {
            Route::resource('hotel/assignment', HotelAssignmentController::class)->except(['show']);
        });
    });