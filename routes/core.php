<?php

use App\Http\Controllers\CoreController;
use Illuminate\Support\Facades\Route;
use App\Functions\Core;

Route::get('/language/{locale}', function ($locale) {
    app()->setlocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name('actions.language.index');


function array_flatten($array)
{
    $result = [];
    foreach ($array as $item) {
        if (is_array($item)) {
            $result = array_merge($result, array_flatten($item));
        } else {
            $result[] = $item;
        }
    }
    return $result;
}

Route::get(
    '/test',
    function () {
        $combined = [
            Core::genderList(),
            Core::periodList(),
            Core::identityList(),
            Core::transmissionList(),
            Core::fuelList(),
            Core::powerList(),
            ['mileage', 'pending', 'completed'],
            Core::cityList(),
            array_keys(Core::stateList()),
            Core::nationList(),
            array_keys(Core::consList()),
            array_keys(Core::brandList()),
            array_values(Core::consList()),
            array_values(Core::brandList()),
        ];

        $data = [];
        collect(array_flatten($combined))->each(function ($e) use (&$data) {
            if ((float)$e) return;
            $data[$e] = $e;
        });
        dd(json_encode($data));
    }
);


Route::group(['prefix' => '/admin', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', [CoreController::class, 'index_view'])->name('views.core.index');
    Route::get('/calendar', [CoreController::class, 'calendar_view'])->name('views.core.calendar');
    Route::get('/notifications', [CoreController::class, 'notification_view'])->name('views.core.notification');
    Route::get('/data/most', [CoreController::class, 'most_action'])->name('actions.core.most');
    Route::get('/data/chart', [CoreController::class, 'chart_action'])->name('actions.core.chart');
    Route::get('/data/calendar', [CoreController::class, 'calendar_action'])->name('actions.core.calendar');
});
