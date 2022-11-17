<?php

use Core\Route;
use Core\Request;

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
    Route::get('/', static function (Request $request) {

        return [1, 2];
    }),

    Route::post('/', static function (Request $request) {

        return [3, 4];
    }),

    Route::put('/', static function (Request $request) {

        return [5, 6];
    }),

    Route::delete('/', static function (Request $request) {

        return [7, 8];
    }),
];