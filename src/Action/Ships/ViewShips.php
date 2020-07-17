<?php

namespace ssim\Action\Ships;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

use Slim\Views\Twig;

use ssim\Data\ShipTypes;

final class ViewShips {

  private $twig;

  public function __construct(Twig $twig) {
    $this->twig = $twig;
  }

  public function __invoke(ServerRequest $request, Response $response): ResponseInterface {
    return $this->twig->render($response, 'ships/ships.twig', [
      'shiptypes' => (new ShipTypes())->getTypes()  
    ]);
  }
}