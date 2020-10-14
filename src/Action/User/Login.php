<?php

namespace App\Action\User;

use App\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;
use App\Responder\Responder;

use App\Domain\User\Service\AuthenticateUser;

final class Login extends Action {

  private $twig;
  private $user;
  private $responder;

  public function __construct(Twig $twig, AuthenticateUser $user, Responder $responder) {
    $this->twig = $twig;
    $this->user = $user;
    $this->responder = $responder;
    parent::__construct($twig);
  }

  public function action(): Response {
    $url = $this->user->makeOAuthRequest();
    return $this->responder->basicRedirect($this->response, $url);
  }

}