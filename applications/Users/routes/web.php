<?php

use Illuminate\Support\Facades\Route;
use Rezyon\Applications\Users\Http\Controllers\AdminUsersController;


Route::group(['prefix' => 'yonetim/kullanicilar','middleware'=>['web','auth']], function () {
    Route::get('/',[AdminUsersController::class,'listView'])->name("admin.users.list");
    Route::get('{id}',[AdminUsersController::class,'show'])->name("admin.users.show");
    Route::get('{id}/update/permission',[AdminUsersController::class,'permissionsUpdate'])->name("admin.users.update.permission");

    Route::get('datatables/list',[AdminUsersController::class,'dataTableList'])->name('admin.users.datatable.list');
});
