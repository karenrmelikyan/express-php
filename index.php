<?php

require __DIR__ . '/vendor/autoload.php';
require_once 'core/Server.php';
require_once 'core/Route.php';
require_once 'core/Middleware.php';
require_once 'core/Request.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

(new Core\Server())
    ->setServerHost($_ENV['APP_SERVER_HOST'])
    ->setDBHost($_ENV['APP_DB_HOST'])
    ->setDBName($_ENV['APP_DB_NAME'])
    ->setDBUserName($_ENV['APP_DB_USERNAME'])
    ->setDBPassword($_ENV['APP_DB_PASSWORD'])
    ->run();

















//use React\EventLoop\Loop;
//use React\Http\HttpServer;
//use React\Http\Message\Response;
//use Psr\Http\Message\ServerRequestInterface as Request;
//use React\Promise\Deferred;
//
//$deferred = new \React\Promise\Deferred();
//$loop = React\EventLoop\Loop::get();
//$count = 0;
//
//echo time() . " start\n";
//$loop->addPeriodicTimer(0.5, function ($timer) use($loop, $deferred, &$count){
//  if ($count === 10) {
//      $loop->cancelTimer($timer);
//      $deferred->resolve($count);
//  } else {
//      echo $count ++;
//  }
//});
//
//$deferred->promise()->then(function ($response) {
//    echo time() .  "\nfinish with $response\n";
//});
//
//echo time() . " async is working\n";

