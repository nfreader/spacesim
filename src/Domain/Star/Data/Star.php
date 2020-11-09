<?php

namespace App\Domain\Star\Data;

use App\Domain\Star\Data\Types;

class Star
{
  public int $id;
  public string $name;
  public array $type;
  public int $x;
  public int $y;
  public array $systs = [];

  public function __construct(object $data = null)
  {
    if ($data) {
      $this->id = $this->setId($data->id);
      $this->name = $this->setName($data->name);
      $this->type = $this->setType($data->type);
      $this->x = $this->setXCoord($data->x);
      $this->y = $this->setYCoord($data->y);
    }
  }

  private function setId(int $id)
  {
    return $this->id = $id;
  }

  private function setName(string $name)
  {
    return $this->name = $name;
  }

  private function setType(string $type)
  {
    if (!is_iterable($type)) {
      $types = (new Types)->getTypes();
      return $this->type = $types[$type];
    }
    return $this->type = $type;
  }

  private function setXCoord(int $x)
  {
    return $this->x = $x;
  }

  private function setYCoord(int $y)
  {
    return $this->y = $y;
  }
  public function setSysts($systs)
  {
    return $this->systs = $systs;
  }
}
