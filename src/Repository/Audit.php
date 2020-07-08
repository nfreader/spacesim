<?php

namespace ssim\Repository;

use ssim\Data\AuditTypes;
use ssim\Repository\User;

class Audit extends Repository {

  protected $user;
  protected $types;

  public function __constuct(User $user){
    $this->user = $user;
    // $this->types = (new AuditTypes())->getTypes();
  }

  public function addNew(string $action, string $text){
    var_dump($this->user->currentUser);
    // $this->db->insert('ssim_audit',[
    //   'user' => $this->user->id,
    //   'action' => $action,
    //   'text' => $text,
    //   'ip' => ip2long($_SERVER['REMOTE_ADDR'])
    // ]);
  }

}