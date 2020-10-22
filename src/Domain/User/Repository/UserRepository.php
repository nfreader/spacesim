<?php

namespace App\Domain\User\Repository;

use ParagonIE\EasyDB\EasyDB as DB;
use App\Repository\Database;

class UserRepository extends Database
{

  protected $table = 'user';

  public function getUserByEmail(string $email)
  {
    return $this->DB->row("SELECT u.* FROM $this->table u WHERE email = ?", $email);
  }
}
