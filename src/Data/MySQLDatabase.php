<?php

namespace ssim\Data;

use ParagonIE\EasyDB\Factory;
use ParagonIE\EasyDB\EasyDB;

class MySQLDatabase {

  public $db = null;

  public function __construct(array $connection) {
    $options = [
      \PDO::ATTR_PERSISTENT               => TRUE,
      \PDO::ATTR_ERRMODE                  => \PDO::ERRMODE_EXCEPTION,
      \PDO::ATTR_DEFAULT_FETCH_MODE       => \PDO::FETCH_OBJ,
      \PDO::ATTR_STRINGIFY_FETCHES        => FALSE,
      \PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => TRUE,
      \PDO::MYSQL_ATTR_COMPRESS           => TRUE
    ];
    try{
    $db = \ParagonIE\EasyDB\Factory::fromArray([
      $connection['DB_DSN'],
      $connection['DB_USER'],
      $connection['DB_PASS'],
      $options
    ]);
    $this->db = $db;
    } catch (Exception $e){
      return $e->getMessage();
    }
  }

  public function getDatabase() {
    return $this->db;
  }

}