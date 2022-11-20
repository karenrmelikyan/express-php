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

        return [1, 2];
    }),

    Route::post('/', static function (Request $request) {

        return 'Element was added';
    }),

    Route::put('/', static function (Request $request) {

        return ['name' => 'John'];
    }),

    Route::patch('/', static function (Request $request) {

        return [7, 8];
    }),

    Route::delete('/', static function (Request $request) {

        return 'Element was deleted';
    }),
];