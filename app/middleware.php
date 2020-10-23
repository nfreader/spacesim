<?php

use Slim\App;
use Slim\Views\TwigMiddleware;
use App\Guard\UserGuard;
use App\Middleware\UrlGeneratorMiddleware;

return function (App $app) {
  $app->addBodyParsingMiddleware();
  $app->add(UserGuard::class);
  $app->add(UrlGeneratorMiddleware::class);
  $app->addRoutingMiddleware();
  $app->add(TwigMiddleware::createFromContainer($app, 'view'));
};
