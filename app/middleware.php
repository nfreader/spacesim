<?php

use Slim\App;
use Slim\Views\TwigMiddleware;
use Slim\Middleware\ErrorMiddleware;
// use App\Middleware\HttpExceptionMiddleware;
// use App\Middleware\UserMiddleware;
return function (App $app) {
    $app->addBodyParsingMiddleware();
    // $app->add(UserMiddleware::class);
    $app->addRoutingMiddleware();
    $app->add(TwigMiddleware::createFromContainer($app, 'view'));
    // $app->add(HttpExceptionMiddleware::class);
    // $app->add(ErrorMiddleware::class);
};