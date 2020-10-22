<?php

namespace App\Domain\Star\Repository;

use ParagonIE\EasyDB\EasyDB as DB;
use App\Repository\Database;

class Star extends Database
{

  protected $table = 'star';

  public function insert($data)
  {
    try {
      return $this->DB->insertReturnId($this->table, [
        'name' => $data->name,
        'type' => $data->type['short'],
        'x' => $data->x,
        'y' => $data->y
      ]);
    } catch (\Exception $e) {
      $this->session->getFlashBag()->add(
        'danger',
        "This star was not created"
      );
      return false;
    }
  }
}
