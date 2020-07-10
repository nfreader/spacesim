<?php

namespace ssim\Action\Syst;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

use ssim\Action\ActionHandler;

use Slim\Views\Twig;

use ssim\Repository\Syst;
use ssim\Repository\Spob;

use ssim\Data\SpobTypes;

final class ViewSyst extends ActionHandler{
  
  private $template = 'syst/view.twig';

  private $syst;
  private $twig;

  public function __construct(Twig $twig, Syst $syst, Spob $spob) {
    $this->twig = $twig;
    $this->syst = $syst;
    $this->spob = $spob;
  }

  public function __invoke(ServerRequest $request, Response $response, $args): 
  ResponseInterface {
    $systid = \filter_var($args['systid'], FILTER_VALIDATE_INT);
    if($syst = $this->syst->getSyst($systid, TRUE)) {
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