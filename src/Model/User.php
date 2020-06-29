<?php

namespace ssim\Model;

use ssim\Repository\Permissions;

class User {

  public $id = 0;
  public $email = null;
  public $permissions = false;

  public function __construct($user) {
    $this->email = $user->email;
    $this->id = $user->id;
    $this->permissions = $user->permissions;
  }

}