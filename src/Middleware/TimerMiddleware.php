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
class TimerMiddleware implements MiddlewareInterface {

  public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {
    $start = microtime(true);
    $response = $handler->handle($request);
    $taken = microtime(true) - $start;
    return $response->withHeader('Time-Taken',$taken);
  }

}