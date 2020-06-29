<?php 

namespace ssim\Repository;

use ParagonIE\EasyDB\EasyDB as DB;

class Repository {

  private $db;

  public function __construct(DB $db) {
    $this->db = $db;
  }

}