<?php 

namespace ssim\Action\Game;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

use Slim\Views\Twig;

use ssim\Repository\Pilot;

class LaunchGame {

  protected $twig;
  protected $pilot;

  public function __construct(Twig $twig, Pilot $pilot){
    $this->twig = $twig;
    $this->pilot = $pilot;
  }

  public function __invoke(ServerRequest $request, Response $response): ResponseInterface {
    $data = $request->getParsedBody();
    return $this->twig->render($response, 'base/game.html',[
      'pilot' => $this->pilot->launchPilot($data['pilot'])
    ]);
  }
}