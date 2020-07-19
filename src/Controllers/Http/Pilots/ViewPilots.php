<?php

namespace ssim\Controllers\Http\Pilots;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

use Slim\Views\Twig;

use ssim\Repository\Pilot;

final class ViewPilots {

  private $twig;
  private $pilot;

  public function __construct(Twig $twig, Pilot $pilot) {
    $this->twig = $twig;
    $this->pilot = $pilot;
  }

  public function __invoke(ServerRequest $request, Response $response): ResponseInterface {
    return $this->twig->render($response, 'pilots/view.twig',[
      'pilots' => $this->pilot->getUserPilots()
    ]);
  }
}