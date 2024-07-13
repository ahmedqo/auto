<?php

use App\Http\Controllers\BlacklistController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/admin', 'middleware' => ['auth']], function () {
    Route::get('/blacklist', [BlacklistController::class, 'index_view'])->name('views.blacklist.index');
    Route::get('/blacklist/store', [BlacklistController::class, 'store_view'])->name('views.blacklist.store');
    Route::get('/blacklist/{id}/patch', [BlacklistController::class, 'patch_view'])->name('views.blacklist.patch');

    Route::post('/blacklist/store', [BlacklistController::class, 'store_action'])->name('actions.blacklist.store');
    Route::get('/blacklist/search', [BlacklistController::class, 'search_action'])->name('actions.blacklist.search');
    Route::patch('/blacklist/{id}/patch', [BlacklistController::class, 'patch_action'])->name('actions.blacklist.patch');
    Route::delete('/blacklist/{id}/clear', [BlacklistController::class, 'clear_action'])->name('actions.blacklist.clear');
});
