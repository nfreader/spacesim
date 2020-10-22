<?php

namespace App\Action\User\Auth;

use App\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;
use App\Responder\Responder;
use App\Domain\User\Service\Auth\DiscordAuthenticator;

final class DiscordLogout extends Action
{

  private $twig;
  private $auth;
  private $responder;

  public function __construct(Twig $twig, DiscordAuthenticator $auth, Responder $responder)
  {
    $this->twig = $twig;
    $this->auth = $auth;
    $this->responder = $responder;
    parent::__construct($twig);
  }

  public function action(): Response
  {
    $this->auth->DiscordLogout();
    return $this->responder->redirect($this->response, 'home');
  }
}
