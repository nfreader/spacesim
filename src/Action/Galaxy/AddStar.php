<?php

namespace ssim\Action\Galaxy;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

use ssim\Action\ActionHandler;

use Slim\Views\Twig;
use ssim\Repository\Star;

use ssim\Data\StarTypes;

final class AddStar extends ActionHandler{
  
  private $template = 'galaxy/view.twig';

  private $twig;

  public $types;

  public function __construct(Twig $twig, Star $star) {
    $this->twig = $twig;
    $this->star = $star;
    $this->types = (new StarTypes())->getTypes();
  }

  public function __invoke(ServerRequest $request, Response $response): ResponseInterface {
    if('POST' === $request->getMethod()) {
      $this->star->addNew($request->getParsedBody());
      return $this->twig->render($response, $this->template, [
        'starTypes' => $this->types
      ]);
    }
    return $this->twig->render($response, $this->template, [
      'galaxy' => $this->star->getGalaxy(),
      'starTypes' => $this->types
    ]);
  }
}