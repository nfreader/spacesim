<?php

namespace ssim\Controllers\Http\Account;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

use Slim\Views\Twig;

use ssim\Action\ActionHandler;

use ssim\Repository\User as User;

final class Register extends ActionHandler{

  private $twig;

  private $data = [];

  protected $filterArgs = [
    'email'           => FILTER_SANITIZE_EMAIL,
    'password'        => NULL,
    'password_repeat' => NULL
  ];

  public $defaultMessage = "Your account has been created and will need to be activated before you can continue";

  public function __construct(Twig $twig, User $user) {
    $this->twig = $twig;
    $this->user = $user;
  }

  public function __invoke(ServerRequest $request, Response $response): ResponseInterface {

    parent::ErrorMessage("Your account could not be created at this time", true);

    if($this->register($request->getParsedBody())) {
      parent::SuccessMessage($this->defaultMessage, true);
    }

    return $this->twig->render($response, 'home.twig', [
      'messages' => $this->messages
    ]);
  }

  public function register(array $data) {
    $this->data = (object) $data;
    if(!$this->validateData($this->data)) return false;
    $user = $this->user->addNew($this->data->registerEmail, $this->data->registerPassword);
    if(!$user) return false;
    return true;
  }

  private function validateData() {
    if(empty($this->data->registerPassword)) {
      parent::ErrorMessage("You must enter a password", true);
      return false;
    }
    if(empty($this->data->registerEmail) && !(filter_var($this->data->registerEmail,FILTER_VALIDATE_EMAIL))) {
      parent::ErrorMessage("You must enter an email address", true);
      return false; 
    }
    return true;
  }

}
