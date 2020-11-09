<?php

namespace App\Domain\Spob\Data;

class Spob
{
  public int $id;
  public string $name;
  public int $syst;
  public string $type;
  public int $techlevel;
  public string $desc;
  public bool $homeworld;

  public function setId($id)
  {
    $this->id = $id;
  }

  public function setName($name)
  {
    $this->name = $name;
  }

  public function setSyst(int $syst)
  {
    $this->syst = $syst;
  }

  public function setType($type)
  {
    $this->type = $type;
  }

  public function setTechlevel(int $techlevel)
  {
    $this->techlevel = $techlevel;
  }

  public function setDesc(string $desc)
  {
    $this->desc = $desc;
  }

  public function setHomeworld(bool $homeworld)
  {
    $this->homeworld = $homeworld;
  }
}
