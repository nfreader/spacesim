<?php

namespace App\Domain\Syst\Repository;

use App\Repository\Database;
use App\Domain\Syst\Data\Syst as SystData;
use PDO;

class Syst extends Database
{

  protected string $table = 'syst';
  protected string $fields = 'id, name, distance, star, speed, govt';
  private string $message = 'This system was not created';

  public function insert($data)
  {
    try {
      return $this->DB->insertReturnId($this->table, [
        'name' => $data->name,
        'star' => $data->star,
        'distance' => $data->distance,
        'speed' => $data->speed,
        'govt' => null
      ]);
    } catch (\Exception $e) {
      if ($this->DB->debug) {
        $this->setMessage($e->getMessage());
      }
      return false;
    }
  }
  public function getSyst(int $id)
  {
    $syst = $this->DB->row("SELECT $this->fields FROM $this->table WHERE id = ?", $id);
    return $this->buildSyst($syst);
  }
  public function getSysts(int $star)
  {
    $systs = $this->DB->run("SELECT $this->fields FROM $this->table WHERE star = ?", $star);
    foreach ($systs as &$syst) {
      $syst = $this->buildSyst($syst);
    }
    return $systs;
  }
  public function getAllSysts()
  {
    $systs = $this->DB->run("SELECT $this->fields FROM $this->table");
    foreach ($systs as &$syst) {
      $syst = $this->buildSyst($syst);
    }
    return $systs;
  }
  private function buildSyst($syst)
  {
    return new SystData($syst);
  }
}
