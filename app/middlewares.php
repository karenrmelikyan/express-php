<?php

use Core\Request;

/*
|--------------------------------------------------------------------------
| Middlewares
|--------------------------------------------------------------------------
|
| All middleware functions should return boolean
| type for restricted access to the routes
|
*/

return [

    [
        'routes' => ['/', '/test'],
        'function' => static function (Request $request) {
            return false;
        },
    ],

    [
        'routes' => ['/blog', '/payment'],
        'function' => static function (Request $request) {
            return true;
        },
    ],

];