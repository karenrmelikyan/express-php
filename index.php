<?php

require __DIR__ . '/vendor/autoload.php';

spl_autoload_register(static function ($class_name) {
    include $class_name . '.php';
});

(new Core\Server())->run();

