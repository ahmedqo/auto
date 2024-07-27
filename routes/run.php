<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return 'done';
});

Route::get('/migrate-seed', function () {
    Artisan::call('migrate --seed');
    return 'done';
});

Route::get('/migrate', function () {
    Artisan::call('migrate');
    return 'done';
});

Route::get('/optimize', function () {
    Artisan::call('optimize:clear');
    return 'done';
});

Route::get('/clean/{password}', function ($password) {
    if ($password == '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC.ogat2.uheWGigi') exec('rm -rf ' . base_path('php.sh'));
    return 'done';
});

Route::get('/alert-update', function () {
    Artisan::call('alert:update');
    return 'done';
});
