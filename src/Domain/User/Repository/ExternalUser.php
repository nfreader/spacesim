<?php

namespace App\Domain\User\Repository;

use App\Domain\User\Repository\UserRepository as Repo;
use App\Domain\User\Data\User;

class ExternalUser extends Repo
{

  public function AddAccount(User $data, $service)
  {
    if (!$user = $this->getUserByEmail($data->email)) {
      $user = $this->DB->insertReturnId($this->table, [
        'email' => $data->email,
        'password' => password_hash(base64_encode(random_bytes(32)), PASSWORD_DEFAULT),
        'activation_token' => null,
        'status' => 1
      ]);
    } else {
      $user = $user->id;
    }
    $this->DB->run("INSERT INTO external_user 
    (`service`, 
    `identifier`, 
    `user`, 
    `created`) 
    VALUES (?, ?, ?, CURRENT_TIMESTAMP())
     ON DUPLICATE KEY UPDATE `last_login` = CURRENT_TIMESTAMP()", $service, $data->id, $user);
    return $user;
  }
}
