<?php

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app){
  $app->get('/', \App\Action\IndexAction::class)->setName('home');
  $app->post('/login', \App\Action\IndexAction::class)->setName('account.login');
  $app->post('/register', \App\Action\IndexAction::class)->setName('account.register');

  // $app->post('/login', \App\Action\User\LoginAction::class)->setName('account.login');
  // $app->post('/register', \App\Action\User\RegisterAccountAction::class)->setName('account.register');

};
