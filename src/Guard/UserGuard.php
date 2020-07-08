<?php

namespace ssim\Guard;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Routing\RouteContext;

use ssim\Repository\User;

class UserGuard {

    public function __construct(User $user) {
      $this->user = $user->currentUser;
    }
    /**
     * Example middleware invokable class
     *
     * @param  ServerRequest  $request PSR-7 request
     * @param  RequestHandler $handler PSR-15 request handler
     *
     * @return Response
     */
    public function __invoke(Request $request, RequestHandler $handler): Response {
      $routeContext = RouteContext::fromRequest($request);
      $route = $routeContext->getRoute();
      $permission = $route->getArgument('permission');
      if($permission && false === $this->user->hasPermission($permission)){
        die("Forbidden");
      }
      return $handler->handle($request);
    }
}
