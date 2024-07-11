<?php

use App\Http\Controllers\ModelController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/admin', 'middleware' => ['auth']], function () {
    Route::get('/models', [ModelController::class, 'index_view'])->name('views.models.index');
    Route::get('/models/store', [ModelController::class, 'store_view'])->name('views.models.store');
    Route::get('/models/{id}/patch', [ModelController::class, 'patch_view'])->name('views.models.patch');

    Route::post('/models/store', [ModelController::class, 'store_action'])->name('actions.models.store');
    Route::get('/models/search', [ModelController::class, 'search_action'])->name('actions.models.search');
    Route::patch('/models/{id}/patch', [ModelController::class, 'patch_action'])->name('actions.models.patch');
    Route::delete('/models/{id}/clear', [ModelController::class, 'clear_action'])->name('actions.models.clear');
});
