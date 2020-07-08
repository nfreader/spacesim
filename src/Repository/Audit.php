<?php

namespace ssim\Repository;

class Audit extends Repository {

  public function __constuct(){
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