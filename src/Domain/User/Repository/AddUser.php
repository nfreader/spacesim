<?php

namespace App\Domain\User\Repository;

use App\Domain\User\Repository\UserRepository as Repo;

class AddUser extends Repo {

  public function AddAccount($data){
    return $this->DB->insertReturnId($this->table,[
      'email' => $data['email'],
      'password' => password_hash($data['password'], PASSWORD_DEFAULT),
      'activation_token' => password_hash(base64_encode(random_bytes(32)),PASSWORD_DEFAULT)
    ]);
  }

}