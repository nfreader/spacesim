<?php

use Slim\App;
use Slim\Views\TwigMiddleware;
use ssim\Middleware\TimerMiddleware;
use ssim\Middleware\SessionMiddleware;
use ssim\Guard\UserGuard;
return function (App $app) {
    if(SSIM_DEBUG) $app->add(TimerMiddleware::class);
    $app->addBodyParsingMiddleware();
    $app->add(SessionMiddleware::class);
    $app->add(UserGuard::class);
    $app->add(TwigMiddleware::class);
    $app->addRoutingMiddleware();
};