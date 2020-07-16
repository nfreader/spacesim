<?php

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app){
  $app->get('/', \ssim\Action\Home::class)->setName('home');
  
  $app->map(['GET', 'POST'],'/game', \ssim\Action\Game\LaunchGame::class)->setName('game');

  $app->group('/account', function (RouteCollectorProxy $group){
    $group->post('/register', \ssim\Action\Account\Register::class)->setName('register');
    $group->post('/login', \ssim\Action\Account\Login::class)->setName('login');
    $group->get('/logout', \ssim\Action\Account\Logout::class)->setName('logout');
  });

  $app->group('/pilots', function (RouteCollectorProxy $group){
    $group->get('/', \ssim\Action\Pilots\ViewPilots::class)->setName('pilots.view');
    $group->map(['POST','GET'], '/addCompany', \ssim\Action\Pilots\AddCompany::class)->setName('pilots.addCompany');
    $group->map(['POST','GET'], '/addPilot', \ssim\Action\Pilots\AddPilot::class)->setName('pilots.addPilot');
  });

  $app->group('/galaxy', function (RouteCollectorProxy $group){

    $group->get('/', \ssim\Action\Galaxy\ViewGalaxy::class)->setName('galaxy.view');

    $group->get('/star/{id}', \ssim\Action\Galaxy\ViewStar::class)->setName('galaxy.star');

    $group->map(['POST','GET'], '/addStar', \ssim\Action\Galaxy\AddStar::class)->setName('galaxy.newStar')->setArgument('permission','GALAXY');

    $group->map(['POST','GET'], '/star/{id}/addSyst', \ssim\Action\Syst\AddSyst::class)->setName('galaxy.newSyst')->setArgument('permission','GALAXY');

    $group->map(['POST','GET'], '/star/{starid}/{systid}/addSpob', \ssim\Action\Spob\AddSpob::class)->setName('galaxy.newSpob')->setArgument('permission','GALAXY');

    $group->get('/star/{starid}/{systid}', \ssim\Action\Syst\ViewSyst::class)->setName('galaxy.syst');

  })->add(ssim\Guard\UserGuard::class);
};
