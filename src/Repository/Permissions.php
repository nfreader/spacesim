<?php

namespace ssim\Repository;

use ssim\Repository\Repository;

use ParagonIE\EasyDB\EasyDB as DB;

class Permissions extends Repository {

  public function __construct(DB $db) {
    $this->db = $db;
  }

  public function mapPermissions($user) {
    return $this->db->row("SELECT p.flag, p.last_update FROM ssim_permissions p WHERE p.user = ?", $user);
  }

}