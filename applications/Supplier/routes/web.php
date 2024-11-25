<?php

use Illuminate\Support\Facades\Route;
use Rezyon\Applications\Supplier\Http\Controllers\ActivityControllers;

Route::domain('{subdomain}.' . env('APP_URL'))
    ->middleware('web')
    ->group(function () {
        Route::group(['prefix'=>'yonetim', 'middleware' => ['web', 'auth:companies']],function(){

            Route::group(['prefix'=>'aktivite'],function(){
                Route::post('ekle',[ActivityControllers::class,'store'])->name('supplier.activity.store');
                Route::get('ekle',[ActivityControllers::class,'index'])->name('supplier.activity.add');
                Route::get('listele',[ActivityControllers::class,'list'])->name('supplier.activity.list');
                Route::get('get/categories',[ActivityControllers::class,'getCategories'])->name('supplier.categories.list');
                Route::get('{id}',[ActivityControllers::class, 'show'])->name('supplier.activity.show');
                Route::get('pool/pending',[ActivityControllers::class, 'poolPending'])->name('supplier.activity.pool.pending');
                Route::get('/pool/pending/{id}',[ActivityControllers::class, 'poolPendingShow'])->name('supplier.activity.pool.pending.show');
                Route::post('/pool/pending/{id}/approve',[ActivityControllers::class, 'poolPendingApprove'])->name('supplier.activity.pool.pending.approve');
                Route::post('/pool/pending/{id}/reject',[ActivityControllers::class, 'poolPendingReject'])->name('supplier.activity.pool.pending.reject');
                Route::get('/sessions/{activity}', [ActivityControllers::class, 'getActivitySessions'])->name('supplier.activity.sessions');
            });

            Route::group(['prefix'=>'datatables'],function(){
                Route::get('list', [ActivityControllers::class, 'datatablesList'])->name('datatables.activity.list');
                Route::get('pool/pending/list', [ActivityControllers::class, 'poolPendingDataTable'])->name('datatables.activity.pool.pending.list');
            });

        });
    });

Route::group(['prefix'=>'yonetim', 'middleware' => ['web']],function(){
    Route::group(['prefix'=>'aktivite'],function(){
        Route::get('onay-bekleyenler', [\Rezyon\Applications\Supplier\Http\Controllers\ActivitiesPendingApproval::class, 'index'])->name('admin.activity.pendings');
        Route::get('onay-bekleyenler/{id}', [\Rezyon\Applications\Supplier\Http\Controllers\ActivitiesPendingApproval::class, 'show'])->name('admin.activity.pendings.show');
        Route::get('onay-bekleyenler/detay/{id}', [\Rezyon\Applications\Supplier\Http\Controllers\ActivitiesPendingApproval::class, 'detail'])->name('admin.activity.pendings.detail');
        Route::post('onay-bekleyenler/onayla/{id}', [\Rezyon\Applications\Supplier\Http\Controllers\ActivitiesPendingApproval::class, 'confirm'])->name('admin.activity.pendings.confirm');
        Route::post('onay-bekleyenler/reddet/{id}', [\Rezyon\Applications\Supplier\Http\Controllers\ActivitiesPendingApproval::class, 'reject'])->name('admin.activity.pendings.reject');
    });

    Route::group(['prefix'=>'datatables'],function(){

    });

});