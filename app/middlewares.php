<?php

use App\Core\Middleware;

return [

    Middleware::beforeRoutes([
        '/test',
    ], static function () {
        return false;
    }),


];