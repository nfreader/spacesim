<?php

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app){
  $app->get('/', \App\Action\Index::class)->setName('home');
  $app->get('/login', \App\Action\User\Login::class)->setName('account.login');
  $app->map(['GET','POST'],'/login/discord[/{code}]', \App\Action\User\Auth\Discord::class)->setName('account.login.discord');
  $app->post('/register', \App\Action\User\Register::class)->setName('account.register');

  // $app->post('/login', \App\Action\User\LoginAction::class)->setName('account.login');
  // $app->post('/register', \App\Action\User\RegisterAccountAction::class)->setName('account.register');

};
