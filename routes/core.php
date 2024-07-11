<?php

use App\Http\Controllers\CoreController;
use Illuminate\Support\Facades\Route;

Route::get('/language/{locale}', function ($locale) {
    app()->setlocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name('actions.language.index');

Route::group(['prefix' => '/admin', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', [CoreController::class, 'index_view'])->name('views.core.index');
    Route::get('/data/most', [CoreController::class, 'most_action'])->name('actions.core.most');
    Route::get('/settings', [CoreController::class, 'setting_view'])->name('views.core.settings');
    Route::get('/data/chart', [CoreController::class, 'chart_action'])->name('actions.core.chart');
    Route::patch('/settings', [CoreController::class, 'setting_action'])->name('actions.core.settings');
});
