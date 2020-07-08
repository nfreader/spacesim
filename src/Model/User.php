<?php

namespace ssim\Model;

use ssim\Repository\Permissions;

class User {

  public $id = 0;
  public $email = null;
  public $permissions = [];

  public function __construct($user) {
    $this->email = $user->email;
    $this->id = $user->id;
    $this->permissions = $user->permissions;
  }

  public function hasPermission(?string $permission = null) {
    if (in_array($permission, array_keys($this->permissions), TRUE)){
      return true;
    }
    return false;
  }


}