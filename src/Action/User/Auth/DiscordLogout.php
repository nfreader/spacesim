<?php

namespace App\Action\User\Auth;

use App\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;
use App\Responder\Responder;
use App\Domain\User\Service\Auth\DiscordAuthenticator;

final class DiscordLogout extends Action
{

  private $auth;
  protected $responder;

  public function __construct(DiscordAuthenticator $auth, Responder $responder)
  {
    $this->auth = $auth;
    parent::__construct($responder);
  }

  public function action(): Response
  {
    return $this->respond($this->auth->DiscordLogout());
  }
}
