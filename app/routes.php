<?php

use App\Core\Route;

return [
    Route::post('/', static function() {
        return [1, 2];
    }),

    Route::get('/', static function() {
        return [3, 4];
    }),

    Route::put('/', static function() {
        return [5, 6];
    }),

    Route::delete('/', static function() {
        return [7, 8];
    }),
];
