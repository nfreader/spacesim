<?php

namespace ssim\Action\Pilots;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

use Slim\Views\Twig;

use ssim\Repository\Pilot;

final class AddPilot {

  protected $twig;
  protected $pilot;

  public function __construct(Twig $twig, Pilot $pilot) {
    $this->twig = $twig;
    $this->pilot = $pilot;
  }

  public function __invoke(ServerRequest $request, Response $response): ResponseInterface {
    $this->pilot->addNew($request->getParsedBody());
    return $this->twig->render($response, 'pilots/view.twig',[
      'pilots' => $this->pilot->getUserPilots()
    ]);
  }
}