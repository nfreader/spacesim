<?php

namespace App\Responder;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;

final class Responder {
  
  private $responseFactory;

  public function __construct(ResponseFactoryInterface $responseFactory){
    $this->responseFactory = $responseFactory;
  }

  public function createResponse(): ResponseInterface
    {
        return $this->responseFactory->createResponse()->withHeader('Content-Type', 'text/html; charset=utf-8');
    }

  public function redirect(
    ResponseInterface $response,
    string $destination,
    array $data = [],
    array $queryParams = []
  ): ResponseInterface {
    if (!filter_var($destination, FILTER_VALIDATE_URL)) {
        $destination = $this->urlGenerator->fullUrlFor($destination, $data, $queryParams);
    }

    return $response->withHeader('Location', $destination);
  }

  public function basicRedirect(ResponseInterface $response, $url){
    return $response->withStatus(200)->withHeader('Location',$url);
  }

}