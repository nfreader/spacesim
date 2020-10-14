<?php

namespace App\Action\User\Auth;

use App\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;
use App\Responder\Responder;
use App\Domain\User\Service\Auth\DiscordAuthenticator;

final class Discord extends Action {

  private $twig;
  private $user;
  private $responder;

  public function __construct(Twig $twig, DiscordAuthenticator $auth, Responder $responder) {
    $this->twig = $twig;
    $this->auth = $auth;
    $this->responder = $responder;
    parent::__construct($twig);
  }

  public function action(): Response {
    if(isset($_GET['code'])){
      $this->auth->AuthenticateFromDiscord($_GET['code']);
    } else {
      $url = $this->auth->makeOAuthRequest();
      return $this->responder->basicRedirect($this->response, $url);
    }
  }

}