<?php

use Core\Request;

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
|
|
*/


return [

    '/' => [
        'POST' => static function(Request $request) {
            return $request->getBody();
        }
    ],



    '/test' =>'',

];