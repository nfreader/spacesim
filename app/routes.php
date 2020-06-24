<?php

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app){
  $app->get('/', \ssim\Action\Home::class)->setName('home');
  $app->post('/account/register', \ssim\Action\Account\Register::class)->setName('register');
  $app->post('/account/login', \ssim\Action\Account\Login::class)->setName('login');
};
