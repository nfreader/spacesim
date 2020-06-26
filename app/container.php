<?php

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use DI\Container;
use Slim\App;
use Slim\Factory\AppFactory;
use Slim\Interfaces\RouteParserInterface;
use Slim\Psr7\Factory\UriFactory;
use Selective\Config\Configuration;

use function DI\autowire;

use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use Slim\Views\TwigMiddleware;
use Slim\Views\TwigRuntimeLoader;

use ParagonIE\EasyDB\EasyDB;
use ParagonIE\EasyDB\Factory;

use ssim\Middleware\SessionMiddleware;

return [
  //Settings
  Configuration::class => function(){
    return new Configuration(require __DIR__ . "/config/settings.php");
  },

  // //App
  App::class => function (ContainerInterface $container) {
    AppFactory::setContainer($container);
    $app = AppFactory::create();
    return $app;
  },

  // //Response
  ResponseFactoryInterface::class => function (ContainerInterface $container) {
    return $container->get(App::class)->getResponseFactory();
  },

  // //Route parser
  RouteParserInterface::class => function (ContainerInterface $container) {
    return $container->get(App::class)->getRouteCollector()->getRouteParser();
  },

  // //Twig middleware
  TwigMiddleware::class => function (ContainerInterface $container) {
    return TwigMiddleware::createFromContainer($container->get(App::class), Twig::class);
  },

  EasyDB::class => function (ContainerInterface $container){
    $config = $container->get(Configuration::class);
    $config = $config->getArray('database');
    $options = [
      \PDO::ATTR_PERSISTENT               => TRUE,
      \PDO::ATTR_ERRMODE                  => \PDO::ERRMODE_EXCEPTION,
      \PDO::ATTR_DEFAULT_FETCH_MODE       => \PDO::FETCH_OBJ,
      \PDO::ATTR_STRINGIFY_FETCHES        => FALSE,
      \PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => TRUE,
      \PDO::MYSQL_ATTR_COMPRESS           => TRUE
    ];
    try{
      $db = \ParagonIE\EasyDB\Factory::fromArray([
        $config['DB_DSN'],
        $config['DB_USER'],
        $config['DB_PASS'],
        $options
      ]);
      return $db;
    } catch (Exception $e){
      return $e->getMessage();
    }
  },

  // //Twig itself
  Twig::class => function (ContainerInterface $container){
    $config = $container->get(Configuration::class);
    $twigSettings = $config->getArray('twig');
    $twig = Twig::create($twigSettings['template_dir'], $twigSettings);
    $twig->getEnvironment()->addGlobal('app', $config->getArray('application'));
    $twig->addExtension(new \Twig\Extension\DebugExtension());

    return $twig;
  },

  //Session middleware
  SessionMiddleware::class => autowire(SessionMiddleware::class),
];