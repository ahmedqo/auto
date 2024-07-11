<?php

use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/admin', 'middleware' => ['auth']], function () {
    Route::get('/reservations', [ReservationController::class, 'index_view'])->name('views.reservations.index');
    Route::get('/reservations/store', [ReservationController::class, 'store_view'])->name('views.reservations.store');
    Route::get('/reservations/{id}/patch', [ReservationController::class, 'patch_view'])->name('views.reservations.patch');

    Route::post('/reservations/store', [ReservationController::class, 'store_action'])->name('actions.reservations.store');
    Route::get('/reservations/search', [ReservationController::class, 'search_action'])->name('actions.reservations.search');
    Route::patch('/reservations/{id}/patch', [ReservationController::class, 'patch_action'])->name('actions.reservations.patch');
    Route::delete('/reservations/{id}/clear', [ReservationController::class, 'clear_action'])->name('actions.reservations.clear');
});
