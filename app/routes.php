<?php

use App\Core\Route;
use App\Core\Request;

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
    Route::post('/', static function (Request $request) {

        return [$request->getBody(), 2];
    }),

    Route::get('/', static function (Request $request) {

        return [3, $request->getRoute()];
    }),

    Route::put('/', static function (Request $request) {
        return [5, $request->getMethod()];
    }),

    Route::delete('/', static function (Request $request) {
        return [7, $request->getParams()];
    }),
];