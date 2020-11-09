<?php

namespace App\Domain\Spob\Repository;

use App\Repository\Database;
use App\Domain\Spob\Data\Spob as SpobData;
use Exception;

class Spob extends Database
{
  protected $table = 'spob';
  private string $message = 'This port was not created';

  public function insert($data)
  {
    try {
      return $this->DB->insertReturnId($this->table, [
        'name' => $data->name,
        'syst' => $data->syst,
        'techlevel' => $data->techlevel,
        'type' => $data->type->short,
        'desc' => $data->desc,
        'homeworld' => $data->homeworld
      ]);
    } catch (Exception $e) {
      if ($this->DB->debug) {
        $this->setMessage($e->getMessage());
      }
      return false;
    }
  }
}
