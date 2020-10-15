<?php

namespace App\Domain\User\Repository;

use App\Domain\User\Repository\UserRepository as Repo;

class ExternalUser extends Repo {

  public function AddAccount($data, $service){
    $user = $this->DB->insertReturnId($this->table,[
      'email' => $data->email,
      'password' => password_hash(base64_encode(random_bytes(32)),PASSWORD_DEFAULT),
      'activation_token' => null,
      'status' => 1
    ]);
    return $this->DB->insert('external_user',[
      'service' => $service,
      'identifier' => $data->id,
      'user' => $user
    ]);
  }

}