<?php

namespace App\Action\User;

use App\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;

use App\Domain\User\Service\CreateUser;

final class Register extends Action {

  public function __construct(Twig $twig, CreateUser $user) {
    $this->twig = $twig;
    $this->user = $user;
    parent::__construct($twig);
  }

  public function action(): Response {
    $this->user->CreateUser($this->request->getParsedBody());
    return $this->respond();
  }

}