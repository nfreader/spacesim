<?php

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
  $app->get('/', \App\Action\Index::class)->setName('home')->setArgument('sessionNotRequired', true);

  $app->get('/login', \App\Action\User\Login::class)->setName('account.login')->setArgument('sessionNotRequired', true);
  $app->map(['GET', 'POST'], '/login/discord', \App\Action\User\Auth\Discord::class)->setName('account.login.discord')->setArgument('sessionNotRequired', true);
  $app->get('/logout/discord', \App\Action\User\Auth\DiscordLogout::class)->setName('account.logout.discord')->setArgument('sessionNotRequired', true);

  // $app->post('/register', \App\Action\User\Register::class)->setName('account.register');

  // $app->post('/login', \App\Action\User\LoginAction::class)->setName('account.login');
  // $app->post('/register', \App\Action\User\RegisterAccountAction::class)->setName('account.register');

  $app->get('/galaxy', \App\Action\Galaxy\ListGalaxy::class)->setName('galaxy');
  $app->post('/star/addStar', \App\Action\Star\AddStar::class)->setName('star.add')->setArgument('permission', 'GALAXY');
  $app->get('/star/{id}', \App\Action\Star\ViewStar::class)->setName('star.view');
};
