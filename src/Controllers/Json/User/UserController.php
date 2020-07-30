<?php 

namespace ssim\Controllers\Json\User;

use ssim\Controllers\Json\JsonController;
use ssim\Repository\User;

abstract class UserController extends JsonController {

  protected $user;

  public function __construct(User $user) {
    $this->user = $user;
  }

}