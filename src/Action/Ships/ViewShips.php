<?php

namespace ssim\Action\Ships;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

use Slim\Views\Twig;

use ssim\Data\ShipTypes;
use ssim\Repository\Ship;

final class ViewShips {

  protected $twig;
  protected $ship;

  public function __construct(Twig $twig, Ship $ship) {
    $this->twig = $twig;
    $this->ship = $ship;
  }

  public function __invoke(ServerRequest $request, Response $response): ResponseInterface {
    return $this->twig->render($response, 'ships/ships.twig', [
      'shiptypes' => (new ShipTypes())->getTypes(),
      'ships' => $this->ship->getShipyard()
    ]);
  }
}