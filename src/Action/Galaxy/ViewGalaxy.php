<?php

namespace ssim\Action\Galaxy;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

use ssim\Action\ActionHandler;

use Slim\Views\Twig;

final class ViewGalaxy extends ActionHandler{
  
  private $twig;

  public function __construct(Twig $twig) {
    $this->twig = $twig;
  }

  public function __invoke(ServerRequest $request, Response $response): ResponseInterface {
    return $this->twig->render($response, 'galaxy/view.twig', [
      'messages' => $this->messages
    ]);
  }
}