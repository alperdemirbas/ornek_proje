<?php

use Illuminate\Support\Facades\Route;
use Rezyon\Applications\Carts\Http\Controllers\Api\CartController;

Route::group(['prefix' => 'api', 'middleware' => ['api', 'auth:tourism-user-api']], function() {
    Route::get('cart/check', [CartController::class, 'check']);
    Route::get('cart/{lang?}', [CartController::class, 'index']);
    Route::post('cart/add', [CartController::class, 'store']);
    Route::match(['put', 'patch'], 'cart/update/{cart}', [CartController::class, 'update']);
    Route::delete('cart/remove/{cart}', [CartController::class, 'destroy']);
    Route::post('cart/discount', [CartController::class, 'applyDiscount']);
    Route::delete('cart/discount', [CartController::class, 'removeDiscount']);
});