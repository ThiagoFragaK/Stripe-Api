<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeController;

Route::fallback(function() {
    return "Error to find path";
});

Route::controller(StripeController::class)
    ->prefix('stripe')
    ->group(function () {
        Route::get('/balance', 'getBalance');
        Route::post('/auth', 'authenticate');
    }
);