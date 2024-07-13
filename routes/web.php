<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('views.login.index');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/core.php';
require __DIR__ . '/profile.php';

require __DIR__ . '/reservation.php';
require __DIR__ . '/charge.php';

require __DIR__ . '/blacklist.php';
require __DIR__ . '/client.php';
require __DIR__ . '/user.php';

require __DIR__ . '/brand.php';
require __DIR__ . '/model.php';
require __DIR__ . '/vehicle.php';
