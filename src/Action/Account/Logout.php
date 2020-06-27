<?php

namespace ssim\Action\Account;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

use Slim\Views\Twig;

use ssim\Action\ActionHandler;

final class Logout extends ActionHandler{

  private $twig;

  public function __construct(Twig $twig) {
    $this->twig = $twig;
  }

  public function __invoke(ServerRequest $request, Response $response): ResponseInterface {
    unset($_SESSION[SSIM_IDENT]);
    \session_destroy();
    parent::SuccessMessage("You have been logged out", true);
    $this->twig->getEnvironment()->addGlobal('user', false);
    return $this->twig->render($response, 'home.twig', [
      'messages' => $this->messages
    ]);
  }

}
