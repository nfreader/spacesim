<?php

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use DI\Container;
use Slim\App;
use Slim\Factory\AppFactory;
use Slim\Interfaces\RouteParserInterface;
use Slim\Psr7\Factory\UriFactory;
use Slim\Middleware\ErrorMiddleware;

use function DI\autowire;

use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use Slim\Views\TwigMiddleware;
use Slim\Views\TwigRuntimeLoader;

use ParagonIE\EasyDB\EasyDB;
use ParagonIE\EasyDB\Factory;

use App\Handler\DefaultErrorHandler;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;

use GuzzleHttp\Client as Guzzle;

use App\Repository\Database;
use App\Middleware\SessionMiddleware;
use App\Domain\User\Service\Auth\Auth;
use App\Provider\DiscordAuthProvider;
use App\Data\Permissions;
use App\Domain\User\Repository\UserRepository;
use App\Domain\User\Service\GetCurrentUser;
use App\Routing\UrlGenerator;
use App\Middleware\UrlGeneratorMiddleware;


use App\Data\Payload\ActionPayload as Payload;
use App\Data\Payload\ActionErrorPayload as Error;

use Slim\Psr7\Request;

return [
  //Settings
  'settings' => function () {
    return require __DIR__ . '/settings.php';
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

  // Twig templates
  Twig::class => function (ContainerInterface $container) {
    $config = (array)$container->get('settings');
    $session = $container->get(Session::class);
    $settings = $config['twig'];
    $options = $settings['options'];
    $options['cache'] = $options['cache_enabled'] ? $options['cache_path'] : false;

    $twig = Twig::create($settings['paths'], $options);

    $loader = $twig->getLoader();
    $publicPath = (string)$config['public'];
    if ($loader instanceof FilesystemLoader) {
      $loader->addPath($publicPath, 'public');
    }

    $twig->addExtension(new \Twig\Extension\DebugExtension());
    $twig->getEnvironment()->addGlobal('app', $config['app']);
    $twig->getEnvironment()->addGlobal('modules', $config['modules']);
    $twig->getEnvironment()->addGlobal('flash', $session->getFlashBag()->all());
    $twig->getEnvironment()->addGlobal('user', $session->get('user'));

    return $twig;
  },

  'view' => static function (Container $container) {
    return $container->get(Twig::class);
  },

  EasyDB::class => function (ContainerInterface $container) {
    $config = (array) $container->get('settings')['database'];
    try {
      $db = \ParagonIE\EasyDB\Factory::fromArray([
        $config['dsn'] = $config['method'] . ':host=' . $config['host'] . ';port=' . $config['port'] . ';dbname=' . $config['database'],
        $config['username'],
        $config['password'],
        $config['flags']
      ]);
    } catch (Exception $e) {
      return false;
    }
    $db->prefix = $config['prefix'];
    return $db;
  },

  ErrorMiddleware::class => function (ContainerInterface $container) {
    $config = $container->get('settings')['error'];

    $app = $container->get(App::class);

    $errorMiddleware = new ErrorMiddleware(
      $app->getCallableResolver(),
      $app->getResponseFactory(),
      (bool)$config['display_error_details'],
      (bool)$config['log_errors'],
      (bool)$config['log_error_details']
    );

    $errorMiddleware->setDefaultErrorHandler($container->get(DefaultErrorHandler::class));

    return $errorMiddleware;
  },

  Session::class => function (ContainerInterface $container) {
    $settings = $container->get('settings')['session'];
    if (PHP_SAPI === 'cli') {
      return new Session(new MockArraySessionStorage());
    } else {
      return new Session(new NativeSessionStorage($settings));
    }
  },

  SessionInterface::class => function (ContainerInterface $container) {
    return $container->get(Session::class);
  },

  SessionMiddleware::class => function (ContainerInterface $container) {
    return new SessionMiddleware($container->get(SessionInterface::class), $container->get(CurrentUser::class));
  },

  //This might not be useful until it gets refactored
  // Auth::class => function (ContainerInterface $container) {
  //   return new Auth($container->get(Session::class), $container->get('settings')['permissions']);
  // },

  Guzzle::class => function (ContainerInterface $container) {
    return new Guzzle();
  },

  DiscordAuthProvider::class => function (ContainerInterface $container) {
    $settings = $container->get('settings')['auth']['discord'];
    return new DiscordAuthProvider($settings, $container->get(Guzzle::class));
  },

  Permissions::class => function (ContainerInterface $container) {
    $perms = new Permissions($container->get(EasyDB::class), $container->get(Session::class));
    $perms->__invoke($container->get('settings')['permissions']);
    return $perms;
  },

  CurrentUser::class => function (ContainerInterface $container) {
    return new GetCurrentUser($container->get(UserRepository::class), $container->get(Session::class), $container->get(Permissions::class));
  },

  Service::class => function (ContainerInterface $container) {
    $payload = new Payload();
    $error = new Error();
    return new Service($payload, $error);
  },

  Database::class => function (ContainerInterface $container) {
    return new Database($container->get(EasyDB::class), $container->get(Session::class));
  },
  // UrlGenerator::class => function () {
  //   return new UrlGenerator();
  // },

  // UrlGeneratorMiddleware::class => function (ContainerInterface $container) {
  //   return new UrlGeneratorMiddleware($container->get(UrlGenerator::class));
  // }

];
