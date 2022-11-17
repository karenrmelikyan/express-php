<?php

use Core\Middleware;
use Core\Request;

/*
|--------------------------------------------------------------------------
| Middlewares
|--------------------------------------------------------------------------
|
| Here is where you can register API middlewares for your application.
| These middlewares are listed in the array as array members and should
| have routes for handling before a particular route handler will work.
| The callback function of the middleware must return true in case the
| route handler's allowed to handle these routes and false if not.
|
*/

return [

    //
    Middleware::checkRoutes([
        '/',
        '/test',
    ], static function (Request $request) {

        return true;
    }),

];