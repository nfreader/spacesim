<?php

use DI\ContainerBuilder;
use Slim\App;

require __DIR__ . '/../vendor/autoload.php';

require_once(__DIR__ . '/config/constants.php');
require_once(__DIR__ . '/config/version.php');
require_once(__DIR__ . '/session.php');
require_once(__DIR__ . '/config/game.php');

if(SSIM_DEBUG) header('Access-Control-Allow-Origin: *');

date_default_timezone_set(SSIM_TIMEZONE);

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__ . '/container.php');
$container = $containerBuilder->build();
$app = $container->get(App::class);

(require __DIR__ . '/middleware.php')($app);
(require __DIR__ . '/routes.php')($app);

return $app;