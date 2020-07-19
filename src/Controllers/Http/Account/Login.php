<?php

namespace ssim\Controllers\Http\Account;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

use Slim\Views\Twig;

use ssim\Action\ActionHandler;

use ssim\Repository\User as User;

final class Login extends ActionHandler{

  private $twig;

  private $data = [];

  protected $filterArgs = [
    'email'           => FILTER_SANITIZE_EMAIL,
    'password'        => NULL,
    'password_repeat' => NULL
  ];

  public $defaultMessage = "Your email address or password are incorrect";

  public function __construct(Twig $twig, User $user) {
    $this->twig = $twig;
    $this->user = $user;
  }

  public function __invoke(ServerRequest $request, Response $response): ResponseInterface {

    parent::ErrorMessage($this->defaultMessage, true);

    if($this->login($request->getParsedBody())) {
      parent::SuccessMessage("You are now logged in as ".$_SESSION[SSIM_IDENT]['email'], true);
    }

    return $this->twig->render($response, 'home.twig', [
      'messages' => $this->messages
    ]);
  }

  private function login(array $data) {
    $this->data = (object) $data;
    if(!$this->validateData($this->data)) return false;
    $user = $this->user->login($this->data->loginEmail, $this->data->loginPassword);
    if(!$user) return false;
    $this->twig->getEnvironment()->addGlobal('user', $user);
    return true;
  }

  private function validateData() {
    if(empty($this->data->loginPassword)) {
      parent::ErrorMessage("You must enter a password", true);
      return false;
    }
    if(empty($this->data->loginEmail) && !(filter_var($this->data->loginEmail,FILTER_VALIDATE_EMAIL))) {
      parent::ErrorMessage("You must enter an email address", true);
      return false; 
    }
    return true;
  }

}
