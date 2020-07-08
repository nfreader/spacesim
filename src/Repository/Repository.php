<?php 

namespace ssim\Repository;

use ParagonIE\EasyDB\EasyDB as DB;
use ssim\Notification\Flash;

class Repository {

  protected $db;
  public $flash;

  public function __construct(DB $db, Flash $flash, User $user) {
    $this->db = $db;
    $this->flash = $flash;
    $this->user = $user;
  }

}