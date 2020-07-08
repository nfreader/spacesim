<?php

namespace ssim\Action\Galaxy;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

use ssim\Action\ActionHandler;

use Slim\Views\Twig;

use ssim\Repository\Star;

final class ViewStar extends ActionHandler{
  
  private $template = 'galaxy/view.twig';

  private $star;
  private $twig;

  public function __construct(Twig $twig, Star $star) {
    $this->twig = $twig;
    $this->star = $star;
  }

  public function __invoke(ServerRequest $request, Response $response): ResponseInterface {
    return $this->twig->render($response, $this->template, [
      // 'galaxy' => $this->star->getStar(),
    ]);
  }
}