<?php

namespace ssim\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Response;

use Slim\Views\Twig;
use ssim\Repository\User;

/**
 * Session middleware.
 */
class SessionMiddleware implements MiddlewareInterface {

  private $twig;

  public function __construct(Twig $twig, User $user){
    $this->twig = $twig;
    $this->user = $user;
  }

  public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {
    $this->twig->getEnvironment()->addGlobal('user', $this->user->currentUser);
    $response = $handler->handle($request);
    return $response;
  }

}