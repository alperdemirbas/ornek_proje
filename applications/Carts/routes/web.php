<?php

use Illuminate\Support\Facades\Route;
use Rezyon\Applications\Carts\Http\Controllers\Api\CartController;

Route::domain('{subdomain}.' . env('APP_URL'))
    ->middleware('web')
    ->group(function () {
        Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth:companies']], function () {
            Route::get('cart/cart-by-date', [CartController::class, 'cartByDate'])->name('cart.by.date');
        });
    });