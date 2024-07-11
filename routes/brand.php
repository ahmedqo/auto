<?php

use App\Http\Controllers\BrandController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/admin', 'middleware' => ['auth']], function () {
    Route::get('/brands', [BrandController::class, 'index_view'])->name('views.brands.index');
    Route::get('/brands/store', [BrandController::class, 'store_view'])->name('views.brands.store');
    Route::get('/brands/{id}/patch', [BrandController::class, 'patch_view'])->name('views.brands.patch');

    Route::post('/brands/store', [BrandController::class, 'store_action'])->name('actions.brands.store');
    Route::get('/brands/search', [BrandController::class, 'search_action'])->name('actions.brands.search');
    Route::patch('/brands/{id}/patch', [BrandController::class, 'patch_action'])->name('actions.brands.patch');
    Route::delete('/brands/{id}/clear', [BrandController::class, 'clear_action'])->name('actions.brands.clear');
});
