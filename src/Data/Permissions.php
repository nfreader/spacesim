<?php

namespace App\Data;

use ParagonIE\EasyDB\EasyDB as DB;
use App\Repository\Database;

class Permissions extends Database
{

  protected $permissions = [];
  protected $db;

  protected $table = 'permissions';

  private $perms = [];

  private $flags = 0;

  public function __invoke(array $permissions)
  {
    $this->permissions = $permissions;
  }

  public function mapPermissionsForUser(int $userId)
  {
    $this->getFlagsFromDB($userId);
    foreach ($this->permissions as $p => $v) {
      if ($this->flags & $v) {
        $this->perms[$p] = true;
      }
    }
    return $this->perms;
  }

  private function getFlagsFromDB(int $userId)
  {
    $this->flags = $this->DB->cell("SELECT flags FROM $this->table WHERE user = ?", $userId);
  }
}
