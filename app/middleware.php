<?php

use Slim\App;
use Slim\Views\TwigMiddleware;

return function (App $app) {
    $container = $app->getContainer();
    $app->addBodyParsingMiddleware();
    $app->add(TwigMiddleware::class);
    $app->addRoutingMiddleware();
};