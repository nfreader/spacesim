<?php

namespace ssim\Controllers\Http\Spob;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

use ssim\Controllers\Http\ActionHandler;

use Slim\Views\Twig;

use ssim\Repository\Spob;
use ssim\Repository\Syst;

use ssim\Data\SpobTypes;

final class AddSpob extends ActionHandler{
  
  private $template = 'syst/view.twig';

  private $spob;
  private $twig;

  public function __construct(Twig $twig, Spob $spob, Syst $syst) {
    $this->twig = $twig;
    $this->spob = $spob;
    $this->syst = $syst;
  }

  public function __invoke(ServerRequest $request, Response $response, $args): 
  ResponseInterface {
    $payload = $request->getParsedBody();
    $payload['syst'] = \filter_var($args['systid'], FILTER_VALIDATE_INT);
    $payload['star'] = \filter_var($args['starid'], FILTER_VALIDATE_INT);
    $this->spob->addNew($payload);
    if($syst = $this->syst->getSyst($payload['syst'], TRUE)) {
      return $this->twig->render($response, $this->template, [
        'star' => $syst->star,
        'syst' => $syst,
        'spobs' => $this->spob->getSpobs($syst->id),
        'spobTypes' => (new SpobTypes())->getTypes()
      ]);
    }
    return $this->twig->render($response, 'base/error.twig');
  }
}