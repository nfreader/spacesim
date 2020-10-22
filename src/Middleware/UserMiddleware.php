<?php

namespace App\Middleware;

use Symfony\Component\HttpFoundation\Session\Session;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

use App\Domain\User\Data\User;

class UserMiddleware
{

  public function __construct(Responder $responder, Session $session)
  {
    $this->responder = $responder;
    $this->session = $session;
  }
  public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
  {
    if ($this->session->get('user') instanceof User) {
      return $handler->handle($request);
    }
    $this->session->getFlashBag()->add(
      'error',
      "You must be logged in to access this resource"
    );
    return $this->responder->redirect($this->responder->createResponse(), 'home');
  }
}
