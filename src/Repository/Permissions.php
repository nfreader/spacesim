<?php

namespace ssim\Repository;

use ssim\Repository\Repository;

use ParagonIE\EasyDB\EasyDB as DB;
use Selective\Config\Configuration as Config;

class Permissions extends Repository {

  private $db;
  private $config;

  private $flags;

  private $perms = [];

  public function __construct(DB $db, Config $config) {
    $this->db = $db;
    $this->config = $config;
    $this->flags = $this->config->getArray('permissions_flags');
  }

  public function mapPermissions($user) {
    $user = $this->db->row("SELECT p.flag, p.last_update FROM ssim_permissions p WHERE p.user = ?", $user);
    var_dump($this->flags);
    foreach($this->flags as $p => $v) {
      if($user->flag & $v){
        $this->perms[] = $p;
      }
    }
    return $this->perms;
  }

}