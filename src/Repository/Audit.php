<?php

namespace ssim\Repository;

use ParagonIE\EasyDB\EasyDB as DB;

class Audit extends Repository {

  public function __constuct(DB $db){
    $this->db = $db;
  }

  public function addNew(string $action, string $text){
    $this->db->insert('ssim_audit',[
      'user' => $this->user->currentUser->id,
      'action' => $action,
      'text' => $text,
      'ip' => ip2long($_SERVER['REMOTE_ADDR'])
    ]);
  }

}