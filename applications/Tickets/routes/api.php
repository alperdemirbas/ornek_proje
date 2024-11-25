<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api', 'middleware' => ['api', 'auth:tourism-user-api']], function() {
    Route::get('tickets/{lang?}', [\Rezyon\Applications\Tickets\Http\Controllers\Api\TicketsController::class, 'list'])
        ->where('lang', 'tr|en');
    Route::put('tickets/{ticket}', [\Rezyon\Applications\Tickets\Http\Controllers\Api\TicketsController::class, 'useTicket']);
    Route::post('tickets/{ticket}', [\Rezyon\Applications\Tickets\Http\Controllers\Api\TicketsController::class, 'ownTicket']);
    Route::post('tickets', [\Rezyon\Applications\Tickets\Http\Controllers\Api\TicketsController::class, 'addTicketToWallet']);
    Route::delete('tickets/{ticket}', [\Rezyon\Applications\Tickets\Http\Controllers\Api\TicketsController::class, 'removeAssignment']);
    Route::get('tickets/{ticket}/{lang?}', [\Rezyon\Applications\Tickets\Http\Controllers\Api\TicketsController::class, 'show']);
});

