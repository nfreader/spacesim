<?php

namespace ssim\Controllers\Json;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Slim\Exception\HttpBadRequestException;

abstract class JsonController {

  public function __invoke(Request $request, Response $response, $args): Response {
    $this->request = $request;
    $this->response = $response;
    $this->args = $args;

    try {
      return $this->action();
    } catch (Exception $e) {
      throw new HttpNotFoundException($this->request, $e->getMessage());
    }
  }

  protected function respond($data, $code = 200): Response {
    $json = json_encode($data, JSON_PRETTY_PRINT);
    $this->response->getBody()->write($json);

    return $this->response->withHeader('Content-Type', 'application/json')
      ->withStatus($code);
  }
  
  protected function resolveArg(string $name){
    if(!isset($this->args[$name])){
      throw new HttpBadRequestException($this->request, "Could not resolve argument `{$name}`.");
    }
    return $this->args[$name];
  }

  protected function resolveOptionalArg(string $name){
    if(!isset($this->args[$name])){
      return false;
    }
    return $this->args[$name];
  }

  abstract protected function action(): Response;

  protected function getFormData() {
    $input = json_decode(file_get_contents('php://input'));

    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new HttpBadRequestException($this->request, 'Malformed JSON input.');
    }

    return $input;
  }

}