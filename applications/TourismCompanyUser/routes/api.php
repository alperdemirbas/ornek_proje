<?php


use Illuminate\Support\Facades\Route;
use Rezyon\Applications\TourismCompanyUser\Http\Controllers\AuthController;


Route::group([
    'prefix' => 'api',
    'middleware' => 'api'
], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::group(['middleware'=>'auth:tourism-user-api'],function(){
            Route::post('/refresh',[AuthController::class,'refresh']);
            Route::post('/logout',[AuthController::class,'logout']);
            Route::get('/me',[AuthController::class,'me']);
        });
    });
});
