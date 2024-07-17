<?php

use App\Http\Controllers\AlertController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/admin', 'middleware' => ['auth']], function () {
    Route::get('/alerts', [AlertController::class, 'index_view'])->name('views.alerts.index');
    Route::get('/alerts/store', [AlertController::class, 'store_view'])->name('views.alerts.store');
    Route::get('/alerts/{id}/patch', [AlertController::class, 'patch_view'])->name('views.alerts.patch');

    Route::post('/alerts/store', [AlertController::class, 'store_action'])->name('actions.alerts.store');
    Route::get('/alerts/search', [AlertController::class, 'search_action'])->name('actions.alerts.search');
    Route::patch('/alerts/{id}/patch', [AlertController::class, 'patch_action'])->name('actions.alerts.patch');
    Route::delete('/alerts/{id}/clear', [AlertController::class, 'clear_action'])->name('actions.alerts.clear');
});
