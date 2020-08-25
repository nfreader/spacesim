<?php 

namespace ssim\Controllers\Json\User;

use Psr\Http\Message\ResponseInterface as Response;
use ssim\Controllers\Json\User\UserController;

class WhoAmI extends UserController {

  public function action(): Response {
    $token = $this->request->getHeader('Authorization')[0];
    $this->user->whoAmI($token);
  }

}