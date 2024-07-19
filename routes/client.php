<?php


use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/admin', 'middleware' => ['auth']], function () {
    Route::get('/clients', [ClientController::class, 'index_view'])->name('views.clients.index');
    Route::get('/clients/store', [ClientController::class, 'store_view'])->name('views.clients.store');
    Route::get('/clients/{id}/patch', [ClientController::class, 'patch_view'])->name('views.clients.patch');
    Route::get('/clients/{id}/scene', [ClientController::class, 'scene_view'])->name('views.clients.scene');

    Route::post('/clients/store', [ClientController::class, 'store_action'])->name('actions.clients.store');
    Route::get('/clients/search', [ClientController::class, 'search_action'])->name('actions.clients.search');
    Route::patch('/clients/{id}/patch', [ClientController::class, 'patch_action'])->name('actions.clients.patch');
    Route::delete('/clients/{id}/clear', [ClientController::class, 'clear_action'])->name('actions.clients.clear');
    Route::get('/clients/{id}/reservations/search', [ClientController::class, 'search_reservations_action'])->name('actions.clients.reservations.search');
    Route::get('/clients/{id}/reservations/filter', [ClientController::class, 'filter_reservations_action'])->name('actions.clients.reservations.filter');
    Route::get('/clients/{id}/chart', [ClientController::class, 'chart_action'])->name('actions.clients.chart');
});
