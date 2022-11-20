<?php

require_once __DIR__ . '/vendor/autoload.php';

spl_autoload_register(static function ($class_name) {
    require_once $class_name . '.php';
});

(new Core\Server())->run();
