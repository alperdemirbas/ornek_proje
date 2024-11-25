<?php


use Rezyon\Applications\Packages\Http\Controllers\PackagesController;

Route::group(['prefix'=>'paketler','middleware'=>'web'],function(){
    Route::get('/datatable',[PackagesController::class,'datatableList'])->name('packages.view.datatable');
    Route::get('/ekle',[PackagesController::class,'create'])->name('packages.view.create');
    Route::post('/ekle',[PackagesController::class,'store'])->name('packages.view.store');
    Route::get('/',[PackagesController::class,'viewList'])->name('packages.view.list');
    Route::post('/{id}/update',[PackagesController::class,'update'])->name('packages.update');
    Route::get('/{id}',[PackagesController::class,'show'])->name('packages.show');
    Route::get('/{id}/edit',[PackagesController::class,'edit'])->name('packages.edit');

});
