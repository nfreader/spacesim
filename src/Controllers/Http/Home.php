<?php

namespace ssim\Controllers\Http;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

use Slim\Views\Twig;

final class Home {

  private $twig;

  public function __construct(Twig $twig) {
    $this->twig = $twig;
  }

  public function __invoke(ServerRequest $request, Response $response): ResponseInterface {
    return $this->twig->render($response, 'home.twig');
  }
}