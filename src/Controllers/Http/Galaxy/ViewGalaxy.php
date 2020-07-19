<?php

namespace ssim\Controllers\Http\Galaxy;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

use ssim\Action\ActionHandler;

use Slim\Views\Twig;

use ssim\Aggregate\Galaxy;

use ssim\Data\StarTypes;

final class ViewGalaxy extends ActionHandler{
  
  private $template = 'galaxy/view.twig';

  private $star;

  private $twig;

  public $types;

  public function __construct(Twig $twig, Galaxy $galaxy) {
    $this->twig = $twig;
    $this->galaxy = $galaxy;
  }

  public function __invoke(ServerRequest $request, Response $response): ResponseInterface {
    return $this->twig->render($response, $this->template, [
      'galaxy' => $this->galaxy->getGalaxy(),
      'starTypes' => (new StarTypes())->getTypes()
    ]);
  }
}