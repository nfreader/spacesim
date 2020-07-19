<?php

namespace ssim\Controllers\Http\Syst;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

use ssim\Controllers\Http\ActionHandler;

use Slim\Views\Twig;

use ssim\Repository\Star;
use ssim\Repository\Syst;

final class AddSyst extends ActionHandler{
  
  private $template = 'star/view.twig';

  private $twig;
  private $star;
  private $syst;

  public function __construct(Twig $twig, Star $star, Syst $syst) {
    $this->twig = $twig;
    $this->star = $star;
    $this->syst = $syst;
  }

  public function __invoke(ServerRequest $request, Response $response, $args): 
  ResponseInterface {
    $id = \filter_var($args['id'], FILTER_VALIDATE_INT);
    if('POST' === $request->getMethod()) {
      $payload = $request->getParsedBody();
      $payload['star'] = $id;
      $this->syst->addNew($payload);
      if($star = $this->star->getStar($id)) {
        return $this->twig->render($response, $this->template,[
          'star' => $star
        ]);
      }
    }
    return $this->twig->render($response, $this->template, [
      'galaxy' => $this->star->getStars(),
      'starTypes' => $this->types
    ]);
  }
}