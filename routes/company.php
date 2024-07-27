<?php

use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CompanyController::class, 'store_view'])->name('views.companies.store');
Route::post('/companies/store', [CompanyController::class, 'store_action'])->name('actions.companies.store');

Route::group(['prefix' => '/admin', 'middleware' => ['auth']], function () {
    Route::get('/settings', [CompanyController::class, 'patch_view'])->name('views.core.settings');
    Route::patch('/settings', [CompanyController::class, 'patch_action'])->name('actions.core.settings');
});
