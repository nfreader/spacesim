<?php

use Slim\App;
use Slim\Views\TwigMiddleware;

use ssim\Middleware\TimerMiddleware;
use ssim\Middleware\SessionMiddleware;

return function (App $app) {
    $container = $app->getContainer();
    if(SSIM_DEBUG) $app->add(TimerMiddleware::class);
    $app->add(SessionMiddleware::class);
    $app->addBodyParsingMiddleware();
    $app->add(TwigMiddleware::class);
    $app->addRoutingMiddleware();
};