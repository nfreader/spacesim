<?php

namespace ssim\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Response;

use Slim\Views\Twig;

/**
 * Session middleware.
 */
class SessionMiddleware implements MiddlewareInterface {

  private $twig;

  public function __construct(Twig $twig){
    $this->twig = $twig;
  }

  public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {
    $this->twig->getEnvironment()->addGlobal('session', $_SESSION);
    // $user = new ssim\Repository\User();
    var_dump($_SERVER);
    $response = $handler->handle($request);
    return $response;
  }

}