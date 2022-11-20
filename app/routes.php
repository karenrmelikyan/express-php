<?php

use Core\Route;
use Core\Request;

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application.
| These route handlers must be listed as array elements of the array.
| Routes handler, always should return either array or string, in
| all other cases will be thrown runtime exception.
|
*/

return [
    Route::get('/', static function (Request $request) {

        return 0;
    }),

    Route::post('/', static function (Request $request) {

        return 'hello express-php';
    }),

    Route::put('/', static function (Request $request) {

        return [5, 6];
    }),

    Route::patch('/', static function (Request $request) {

        return [7, 8];
    }),

    Route::delete('/', static function (Request $request) {

        return [9, 10];
    }),
];