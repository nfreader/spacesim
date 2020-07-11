<?php

namespace ssim\Model;

use ssim\Repository\Permissions;

class User {

  public $id = 0;
  public $email = null;
  public $permissions = [];
  public $company;

  public function __construct($user) {
    $this->email = $user->email;
    $this->id = $user->id;
    $this->permissions = $user->permissions;
    $this->company = $user->company;
  }

  public function hasPermission(?string $permission = null) {
    if (in_array($permission, array_keys($this->permissions), TRUE)){
      return true;
    }
    return false;
  }

  public function getId(){
    return $this->id;
  }


}