<?php

use Core\Request;

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
|
|
*/

function test()
{
    return 'test';
}

return [

    '/' =>
       [
           'GET' => gettype(&$test),
       ],
       [
           'POST' => ''
       ],
       [
           'PUT' => ''
       ],
       [
           'DELETE' => ''
       ],

    '/test' =>
        [
            'GET' => ''
        ],
        [
            'POST' => ''
        ],
        [
            'PUT' => ''
        ],
        [
            'DELETE' => ''
        ],

];