<?php

namespace App\Domain\User\Repository;

use ParagonIE\EasyDB\EasyDB as DB;
use App\Repository\Database;

class UserRepository extends Database
{

  protected $db;

  protected $table = 'user';

  public function __construct(DB $db){
    parent::__construct($db);
  }

  public function getUserByEmail(string $email) {
    return $this->DB->row("SELECT u.* FROM user u WHERE email = ?", $email);
  }

}