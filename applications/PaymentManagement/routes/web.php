<?php

use Illuminate\Support\Facades\Route;
use Rezyon\Applications\PaymentManagement\Http\Controllers\PaymentController;


Route::domain('{subdomain}.' . env('APP_URL'))
    ->group(function () {
        Route::group(['prefix' => 'payment'], function () {
            Route::post('/',[PaymentController::class,'payData'])->name('payment.generate.data');
            Route::get('/', [PaymentController::class, 'pay'])->name('payment.page');
            Route::get('/success/{checkout_id}',[PaymentController::class, 'subSuccess'])->name('payment.sub.success');
        });
        /*Route::group(['prefix'=>'webhooks'],function(){
            Route::post('/paytr',[PaymentController::class,'paytrSuccess'])->name('payment.paytr.success');
            Route::post('/paytr/error',[PaymentController::class,'paytrError'])->name('payment.paytr.error');
        });*/
    });
Route::get('/subscribe/{package}/{cycle}/{type?}', [PaymentController::class, 'subscribe'])->name('payment.subscribe.view');
Route::get('/pricing', [PaymentController::class, 'pricing'])->name('payment.view.pricing');
