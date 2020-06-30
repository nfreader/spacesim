<?php

namespace ssim\Action\Galaxy;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

use ssim\Action\ActionHandler;

use Slim\Views\Twig;

use ssim\Data\StarTypes;

final class ViewGalaxy extends ActionHandler{
  
  protected $template = 'galaxy/view.twig';

  private $twig;

  public $types;

  public function __construct(Twig $twig) {
    $this->twig = $twig;
    $this->types = (new StarTypes())->getTypes(); //TODO: Wrap in galaxy check
  }

  public function __invoke(ServerRequest $request, Response $response): ResponseInterface {

    return $this->twig->render($response, $this->template, [
      'messages' => $this->messages,
      'starTypes' => $this->types
    ]);
  }
}