<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Data\Payload\ResponsePayload as Payload;
use App\Responder\Responder;

abstract class Action
{

  private $responder;

  protected $template = 'home/home.twig';
  protected $error_template = 'error/error.twig';

  public function __construct(Responder $responder)
  {
    $this->responder = $responder;
  }

  public function __invoke(Request $request, Response $response, array $args = []): Response
  {
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

  protected function respond($payload = null): Response
  {
    $type = 'html';
    if (!$payload) $payload = new Payload();
    $payload->template = $this->template;
    if ($payload->getError()) $payload->template = $this->error_template;
    return $this->responder->handle($this->response, $payload);
  }
}
