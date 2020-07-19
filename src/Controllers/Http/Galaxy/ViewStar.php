<?php

namespace ssim\Controllers\Http\Galaxy;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

use ssim\Action\ActionHandler;

use Slim\Views\Twig;

use ssim\Repository\Star;
use ssim\Repository\Syst;

final class ViewStar extends ActionHandler{
  
  private $template = 'star/view.twig';

  private $star;
  private $twig;

  public function __construct(Twig $twig, Star $star, Syst $syst) {
    $this->twig = $twig;
    $this->star = $star;
    $this->syst = $syst;
  }

  public function __invoke(ServerRequest $request, Response $response, $args): 
  ResponseInterface {
    $id = \filter_var($args['id'], FILTER_VALIDATE_INT);
    if($star = $this->star->getStar($id)) {
      $systs = $this->syst->getSysts($id, TRUE);
      return $this->twig->render($response, $this->template, [
        'star' => $star,
        'systs' => $systs
        // 'galaxy' => $this->star->getStar(),
      ]);
    }
    return $this->twig->render($response, 'base/error.twig', [
      'star' => $star
      // 'galaxy' => $this->star->getStar(),
    ]);
  }
}