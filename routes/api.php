<?php

use Josmarh\JVZooIPN\Controllers\IPNController;
use Illuminate\Support\Facades\Route;

Route::prefix(config('jvzoo-ipn.route_prefix'))
    ->group(function () {
        Route::post('/ipn', IPNController::class);
    });
