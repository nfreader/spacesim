<?php

namespace App\Domain\Star\Repository;

use ParagonIE\EasyDB\EasyDB as DB;
use App\Repository\Database;
use App\Domain\Star\Data\Star as StarData;

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
  public function getStars()
  {
    $stars = $this->DB->run("SELECT id, `name`, x, y, `type` FROM $this->table");
    foreach ($stars as &$s) {
      $s = new StarData($s);
    }
    return $stars;
  }
}
