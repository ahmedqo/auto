<?php

use App\Functions\Core;
use App\Models\Alert;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;

Artisan::command('alert:update', function () {
    $today = Carbon::today();
    $dates = [
        'week' => 7,
        'month' => 30,
        'year' => 365,
    ];

    Alert::whereDate('viewed_at', '<', $today)->get()->map(function ($item) use (&$dates) {
        $item->update([
            'viewed_at' => Carbon::parse($item->viewed_at)->addDays(
                $item->unit == 'mileage' ?
                    ceil($item->recurrence / Core::company()->mileage)
                    : ($dates[$item->unit] * $item->recurrence)
            )
        ]);
    });
})->purpose('update alerts dates');
