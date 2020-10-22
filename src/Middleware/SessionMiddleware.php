<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Domain\User\Service\GetCurrentUser as User;

/**
 * Session Middleware.
 */
final class SessionMiddleware implements MiddlewareInterface
{

  private $session;
  private $user;

  public function __construct(Session $session, User $user)
  {
    $this->session = $session;
    $this->user = $user;
  }

  /**
   * Invoke middleware.
   *
   * @param ServerRequestInterface $request The request
   * @param RequestHandlerInterface $handler The handler
   *
   * @return ResponseInterface The response
   */
  public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
  {
    $this->session->start();
    $this->user->GetCurrentUser();
    return $handler->handle($request);
  }
}
