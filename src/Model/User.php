<?php

namespace ssim\Model;

class User {

  public $id = 0;
  public $email = null;

  public function __construct($user) {
    $this->email = $user->email;
    $this->id = $user->id;
  }

}