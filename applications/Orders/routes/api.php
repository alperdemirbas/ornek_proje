<?php

use Illuminate\Support\Facades\Route;
use Rezyon\Applications\Orders\Http\Controllers\OrdersController;

Route::group([
    'prefix' => 'api',
    'middleware' => ['api', 'auth:tourism-user-api']
], function () {
    Route::get('orders/{lang?}', [OrdersController::class, 'getOrders'])->where('lang', '[a-zA-Z]{2}');
    Route::get('orders/{order}/{cart}/{lang?}', [OrdersController::class, 'orderDetail'])->where(['order' => '[0-9]+', 'cart' => '[0-9]+', 'lang' => '[a-zA-Z]{2}?']);
});