<?php

use Illuminate\Support\Facades\Route;
use Rezyon\Applications\TourismCompany\Http\Controllers\ActivityPoolController;

Route::domain('{subdomain}.' . env('APP_URL'))
    ->middleware('web')
    ->group(function () {
        Route::group(['prefix' => 'yonetim', 'middleware' => ['web', 'auth:companies']], function () {
            Route::get('aktivite-havuzu', [ActivityPoolController::class, 'list'])->name('tourism.activity.list');
            Route::get('aktivite-havuzu/listele', [ActivityPoolController::class, 'pool'])->name('tourism.activity.pool');
            Route::post('aktivite-havuzu/ekle/{id}', [ActivityPoolController::class, 'store'])->name('tourism.activity.store');
            Route::get('aktivite-havuzu/detay/{id}', [ActivityPoolController::class, 'detail'])->name('tourism.activity.show');

            Route::post('aktivite-havuzu/update/{id}', [ActivityPoolController::class, 'update'])->name('tourism.activity.pool.update');

            Route::post('aktivite-havuzu/special-day/delete/{id}', [ActivityPoolController::class, 'deleteSpecialDay'])->name('tourism.activity.pool.delete.special.day');

            Route::post('aktivite-havuzu/closed-day/add', [ActivityPoolController::class, 'addClosedDay'])->name('tourism.activity.pool.add.closed.day');

            Route::post('aktivite-havuzu/closed-day/delete/{id}', [ActivityPoolController::class, 'deleteClosedDay'])->name('tourism.activity.pool.delete.closed.day');

            Route::delete('aktivite-havuzu/delete/{id}', [ActivityPoolController::class, 'destroy'])->name('tourism.activity.pool.delete');

            Route::put('aktivite-havuzu/disable/{id}', [ActivityPoolController::class, 'disable'])->name('tourism.activity.pool.disable');

            Route::put('aktivite-havuzu/enable/{id}', [ActivityPoolController::class, 'enable'])->name('tourism.activity.pool.enable');

            Route::group(['prefix'=>'aktivite-havuzu/datatables'],function(){
                Route::get('list', [ActivityPoolController::class, 'datatablesPoolList'])->name('datatables.activity.pool.list');
            });
        });
    });
