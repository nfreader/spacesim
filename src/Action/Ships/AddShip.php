<?php

namespace ssim\Action\Ships;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

use Slim\Views\Twig;

use ssim\Repository\Ship;

use ssim\Data\ShipTypes;

final class AddShip {

  private $twig;

  public function __construct(Twig $twig, Ship $ship) {
    $this->twig = $twig;
    $this->ship = $ship;
  }

  public function __invoke(ServerRequest $request, Response $response): ResponseInterface {
    $data = $this->ship->addNew($request->getParsedBody());
    return $this->twig->render($response, 'ships/ships.twig', [
      'shiptypes' => (new ShipTypes())->getTypes(),
      'data' => $data
    ]);
  }
}