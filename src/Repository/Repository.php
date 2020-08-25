<?php 

namespace ssim\Repository;

use ParagonIE\EasyDB\EasyDB as DB;
use ssim\Notification\Flash;
use Selective\Config\Configuration as Config;

abstract class Repository {

  protected $db;
  protected $flash;
  protected $config;

  public function __construct(DB $db, Flash $flash, Config $config) {
    $this->db = $db;
    $this->flash = $flash;
    $this->config = $config;
  }

}