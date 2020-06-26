<?php

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app){
  $app->get('/', \ssim\Action\Home::class)->setName('home');
  
  $app->group('/account', function (RouteCollectorProxy $group){
    $group->post('/register', \ssim\Action\Account\Register::class)->setName('register');
    $group->post('/login', \ssim\Action\Account\Login::class)->setName('login');
  });
};
