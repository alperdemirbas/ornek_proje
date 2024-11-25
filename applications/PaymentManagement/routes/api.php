<?php

use Illuminate\Support\Facades\Route;
use Rezyon\Applications\PaymentManagement\Http\Controllers\CheckoutController;
use Rezyon\Applications\PaymentManagement\Http\Controllers\PaymentController;

Route::group([
    'prefix' => 'api',
    'middleware' => ['api', 'auth:tourism-user-api']
], function () {
    Route::post('test', [CheckoutController::class, 'checkout']);
    Route::get('pay', [CheckoutController::class, 'pay'])->name('pay');
    Route::get('payment', [PaymentController::class, 'payment']);
    Route::post('order/cancel/{order}', [PaymentController::class, 'makeReturn']);
});

Route::group(['prefix' => 'api', 'middleware' => 'api'], function () {
    Route::post('webhook/payment', [PaymentController::class, 'webhook']);
    Route::get('webhook/payment/success/{token}', [PaymentController::class, 'webhookPaymentSuccess'])->name('webhook.payment.success');
    Route::get('webhook/payment/error/{token}', [PaymentController::class, 'webhookPaymentError'])->name('webhook.payment.error');
});