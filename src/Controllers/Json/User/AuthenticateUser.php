<?php 

namespace ssim\Controllers\Json\User;

use Psr\Http\Message\ResponseInterface as Response;
use ssim\Controllers\Json\User\UserController;

class AuthenticateUser extends UserController {

  public function action(): Response {
    $credentials = $this->getFormData();
    $user = $this->user->ApiLogin($credentials->email, $credentials->password);
    return $this->respondWithData($user);
  }

}