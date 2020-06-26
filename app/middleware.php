<?php

use Slim\App;
use Slim\Views\TwigMiddleware;

// use ssim\Middleware\TimerMiddleware;

return function (App $app) {
    $container = $app->getContainer();
    $app->addBodyParsingMiddleware();
    $app->add(TwigMiddleware::class);
    // if(SSIM_DEBUG) $app->add(TimerMiddleware::class);
    // $app->add(SessionMiddleware::class);
    $app->addRoutingMiddleware();
};