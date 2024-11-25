<?php

use Illuminate\Support\Facades\Route;
use Rezyon\Applications\TourismCompany\Http\Controllers\Api\ActivityPoolController;

Route::group([
    'prefix' => 'api',
    'middleware' => ['api', 'auth:tourism-user-api']
], function () {
    Route::group(['prefix' => 'activity/pool/'], function () {
        Route::get('list/{lang?}', [ActivityPoolController::class, 'list']);
    });
});