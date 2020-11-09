<?php

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
  $app->get('/', \App\Action\Index::class)->setName('home')->setArgument('sessionNotRequired', true);

  $app->get('/login', \App\Action\User\Login::class)->setName('account.login')->setArgument('sessionNotRequired', true);
  $app->map(['GET', 'POST'], '/login/discord', \App\Action\User\Auth\Discord::class)->setName('account.login.discord')->setArgument('sessionNotRequired', true);
  $app->get('/logout/discord', \App\Action\User\Auth\DiscordLogout::class)->setName('account.logout.discord')->setArgument('sessionNotRequired', true);

  $app->get('/galaxy', \App\Action\Galaxy\ListGalaxy::class)->setName('galaxy');
  $app->get('/galaxy/{star}', \App\Action\Star\ViewStar::class)->setName('star.view');
  $app->get('/galaxy/{star}/{syst}', \App\Action\Syst\ViewSyst::class)->setName('syst.view');
  $app->post('/galaxy/addStar', \App\Action\Star\AddStar::class)->setName('star.add')->setArgument('permission', 'GALAXY');
  $app->post('/galaxy/{star}/addSyst', \App\Action\Syst\AddSyst::class)->setName('syst.add')->setArgument('permission', 'GALAXY');
};
