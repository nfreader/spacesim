<?php

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app){
  // BACKEND 
  $app->get('/', \ssim\Controllers\Http\Home::class)->setName('home');

  $app->map(['GET', 'POST'],'/game', \ssim\Controllers\Http\Game\LaunchGame::class)->setName('game');

  $app->group('/account', function (RouteCollectorProxy $group){

    $group->post('/register', \ssim\Controllers\Http\Account\Register::class)->setName('register');

    $group->post('/login', \ssim\Controllers\Http\Account\Login::class)->setName('login');

    $group->get('/logout', \ssim\Controllers\Http\Account\Logout::class)->setName('logout');
  });

  $app->group('/pilots', function (RouteCollectorProxy $group){

    $group->get('/', \ssim\Controllers\Http\Pilots\ViewPilots::class)->setName('pilots.view');

    $group->map(['POST','GET'], '/addCompany', \ssim\Controllers\Http\Pilots\AddCompany::class)->setName('pilots.addCompany');

    $group->map(['POST','GET'], '/addPilot', \ssim\Controllers\Http\Pilots\AddPilot::class)->setName('pilots.addPilot');

  });

  $app->group('/ships', function (RouteCollectorProxy $group){

    $group->get('/', \ssim\Controllers\Http\Ships\ViewShips::class)->setName('ships.view');

    $group->map(['POST','GET'], '/addNew', \ssim\Controllers\Http\Ships\AddShip::class)->setName('ships.newShip');
  });

  $app->group('/galaxy', function (RouteCollectorProxy $group){

    $group->get('/', \ssim\Controllers\Http\Galaxy\ViewGalaxy::class)->setName('galaxy.view');

    $group->get('/star/{id}', \ssim\Controllers\Http\Galaxy\ViewStar::class)->setName('galaxy.star');

    $group->map(['POST','GET'], '/addStar', \ssim\Controllers\Http\Galaxy\AddStar::class)->setName('galaxy.newStar')->setArgument('permission','GALAXY');

    $group->map(['POST','GET'], '/star/{id}/addSyst', \ssim\Controllers\Http\Syst\AddSyst::class)->setName('galaxy.newSyst')->setArgument('permission','GALAXY');

    $group->map(['POST','GET'], '/star/{starid}/{systid}/addSpob', \ssim\Controllers\Http\Spob\AddSpob::class)->setName('galaxy.newSpob')->setArgument('permission','GALAXY');

    $group->get('/star/{starid}/{systid}', \ssim\Controllers\Http\Syst\ViewSyst::class)->setName('galaxy.syst');

  })->add(ssim\Guard\UserGuard::class);
};
