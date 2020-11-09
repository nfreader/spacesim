<?php

namespace App\Repository;

use ParagonIE\EasyDB\EasyDB as DB;
use Symfony\Component\HttpFoundation\Session\Session;

class Database
{

  protected $DB;
  protected $session;

  private string $message = "An error occurred";

  public function __construct(DB $db, Session $session)
  {
    $this->DB = $db;
    $this->session = $session;
  }

  protected function TablePrefix($query)
  {
    if (!$this->DB->prefix) return $query;
    return str_replace('tbl_', $this->DB->prefix, $query);
  }

  protected function setMessage($message)
  {
    $this->message = $message;
  }

  public function getMessage()
  {
    return $this->message;
  }
}
