<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use App\Data\Payload\ActionPayload as Payload;
use App\Data\Payload\ActionErrorPayload as Error;

abstract class Action {

  private $twig;

  protected $template = 'home/home.twig';

  public function __construct(Twig $twig){
    $this->twig = $twig;
  }

  public function __invoke(Request $request, Response $response, array $args = []): ResponseInterface {
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

  protected function respond($payload = []): Response {
    if (!$payload) return $this->respondWithData(new Payload(200));
    if ($payload instanceof Payload) return $this->respondWithData($payload);
    if ($payload instanceof Error) return $this->respondWithError($payload);
  }

  public function respondWithData(Payload $payload): Response{
    $response = $this->response->withStatus($payload->getStatusCode());
    return $this->twig->render($response, $this->template, $payload->getData());
  }

  public function respondWithError(Error $payload): Response {
    $response = $this->response->withStatus($payload->getStatusCode());
    return $this->twig->render($response, $this->template, ['messages'=>$this->messages]);
  }

}