<?php

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app){
  $app->get('/', \ssim\Action\Home::class)->setName('home');
  
  $app->group('/account', function (RouteCollectorProxy $group){
    $group->post('/register', \ssim\Action\Account\Register::class)->setName('register');
    $group->post('/login', \ssim\Action\Account\Login::class)->setName('login');
    $group->get('/logout', \ssim\Action\Account\Logout::class)->setName('logout');
  });

  $app->group('/galaxy', function (RouteCollectorProxy $group){
    $group->get('/', \ssim\Action\Galaxy\ViewGalaxy::class)->setName('galaxy.view');
  });
};
