<?php

namespace App\Domain\Star\Repository;

use App\Repository\Database;
use App\Domain\Star\Data\Star as StarData;

class Star extends Database
{

  protected $table = 'star';

  public function insert($data)
  {
    try {
      return (int) $this->DB->insertReturnId($this->table, [
        'name' => $data->name,
        'type' => $data->type['short'],
        'x' => $data->x,
        'y' => $data->y
      ]);
    } catch (\Exception $e) {
      if ($this->DB->debug) return $e->getMessage();
      return "This star was not created";
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

  public function getStar(int $id)
  {
    $star = $this->DB->row("SELECT id, `name`, x, y, `type` FROM $this->table WHERE id = ?", $id);
    if (!$star) return false;
    return new StarData($star);
  }
}
