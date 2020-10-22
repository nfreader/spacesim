<?php

use Slim\App;
use Slim\Views\TwigMiddleware;
use Slim\Middleware\ErrorMiddleware;
use App\Middleware\SessionMiddleware;
use App\Middleware\UrlGeneratorMiddleware;
use App\Guard\UserGuard;

// use App\Middleware\HttpExceptionMiddleware;
// use App\Middleware\UserMiddleware;
return function (App $app) {
  $app->addBodyParsingMiddleware();
  $app->add(UserGuard::class);
  $app->add(SessionMiddleware::class);
  $app->add(UrlGeneratorMiddleware::class);
  $app->addRoutingMiddleware();
  $app->add(TwigMiddleware::createFromContainer($app, 'view'));
  // $app->add(HttpExceptionMiddleware::class);
  // $app->add(ErrorMiddleware::class);
};
