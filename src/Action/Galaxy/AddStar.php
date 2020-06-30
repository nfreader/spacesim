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

  public $defaultMessage = "This star system could not be added";

  public $types;

  public function __construct(Twig $twig, Star $star) {
    $this->twig = $twig;
    $this->star = $star;
    $this->types = (new StarTypes())->getTypes();
  }

  public function __invoke(ServerRequest $request, Response $response): ResponseInterface {

    parent::ErrorMessage($this->defaultMessage, true);

    //TODO: Change to return error and success messages
    if($star = $this->star->addNew($request->getParsedBody())){
      parent::SuccessMessage("Your star system $star->name has been added", true);
    }

    return $this->twig->render($response, $this->template, [
      'messages' => $this->messages,
      'starTypes' => $this->types
    ]);
  }
}