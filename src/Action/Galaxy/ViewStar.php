<?php

namespace ssim\Action\Galaxy;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

use ssim\Action\ActionHandler;

use Slim\Views\Twig;

use ssim\Repository\Star;

final class ViewStar extends ActionHandler{
  
  private $template = 'star/view.twig';

  private $star;
  private $twig;

  public function __construct(Twig $twig, Star $star) {
    $this->twig = $twig;
    $this->star = $star;
  }

  public function __invoke(ServerRequest $request, Response $response, $args): 
  ResponseInterface {
    $id = \filter_var($args['id'], FILTER_VALIDATE_INT);
    if($star = $this->star->getStar($id)) {
      return $this->twig->render($response, $this->template, [
        'star' => $star
        // 'galaxy' => $this->star->getStar(),
      ]);
    }
    return $this->twig->render($response, 'base/error.twig', [
      'star' => $star
      // 'galaxy' => $this->star->getStar(),
    ]);
  }
}