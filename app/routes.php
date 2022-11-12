<?php

use App\Core\Route;

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application.
| These routes handlers must be listed as array elements within the
| return array. Routes handler, always should return only array.
|
*/

return [
    Route::post('/test', static function() {
        return [1, 2];
    }),

    Route::get('/test2', static function() {
        return [3, 4];
    }),

    Route::put('/', static function() {
        return [5, 6];
    }),

    Route::delete('/', static function() {
        return [7, 8];
    }),
];
