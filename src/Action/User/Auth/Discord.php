<?php

namespace App\Action\User\Auth;

use App\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;
use App\Responder\Responder;
use App\Domain\User\Service\Auth\DiscordAuthenticator;

final class Discord extends Action
{

  private $responder;

  public function __construct(DiscordAuthenticator $auth, Responder $responder)
  {
    $this->auth = $auth;
    parent::__construct($responder);
  }

  public function action(): Response
  {
    if (isset($_GET['code'])) {
      return $this->respond($this->auth->AuthenticateFromDiscord($_GET['code']));
    } else {
      return $this->respond($this->auth->makeOAuthRequest());
    }
  }
}
