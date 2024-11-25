<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\MobileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('main-test');
});
Route::group(['prefix' => 'yonetim', 'middleware' => 'web'], function () {
    Route::get('giris-yap', [AuthController::class, 'index'])->name('admin.view.auth.login');
    Route::post('giris-yap', [AuthController::class, 'authenticate'])->name('admin.auth.login');
    Route::post('cikis', [AuthController::class, 'logout'])->name('admin.auth.logout');
});

Route::group(['prefix' => 'mobil', 'middleware' => 'web'], function () {
    Route::get('uygulama-ayarlari', [MobileController::class,'version'])->name('mobil.app.version');
    Route::post('setting-version',[MobileController::class,'update'])->name('mobile.app.version.update');
});