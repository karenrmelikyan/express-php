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
        'GET' => static function(Request $request) {
            return $request->getBody();
        },

        'POST' => static function(Request $request) {
            return $request->getBody();
        },

        'PUT' => static function(Request $request) {
            return $request->getBody();
        },

        'DELETE' => static function(Request $request) {
            return $request->getBody();
        },
    ],

    '/test' => [

        'GET' => static function(Request $request) {
            return $request->getBody();
        },

        'POST' => static function(Request $request) {
            return $request->getBody();
        },

        'PUT' => static function(Request $request) {
            return $request->getBody();
        },

        'DELETE' => static function(Request $request) {
            return $request->getBody();
        },
    ],




];