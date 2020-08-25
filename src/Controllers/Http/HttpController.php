<?php

namespace ssim\Controllers\Http;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

use Slim\Views\Twig;

abstract class HttpController {

  protected $twig;

  public $template = "base/error.twig";

  public function __construct(Twig $twig) {
    $this->twig = $twig;
  }

  public function __invoke(ServerRequest $request, Response $response): ResponseInterface {
    $this->request = $request;
    $this->response = $response;
    $this->args = $args;

    try {
      return $this->action();
    } catch (Exception $e) {
      throw new HttpNotFoundException($this->request, $e->getMessage());
    }
  }

  abstract protected function action(): Response;

  protected function respond($payload): Response {
    return $this->twig->render($this->response, $payload['template'], $payload);
  }

}