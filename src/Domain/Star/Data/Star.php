<?php

namespace App\Domain\Star\Data;

use App\Domain\Star\Data\Types;
use iterable;

class Star
{
  public int $id;
  public string $name;
  public array $type;
  public int $x;
  public int $y;

  private $types;

  public function __construct(?iterable $data = null)
  {
    $this->types = (new Types)->getTypes();
    if ($data) {
      $data = (object) $data;
      $this->id = $this->setId($data->id);
      $this->name = $this->setName($data->name);
      $this->type = $this->setType($data->type);
      $this->x = $this->setXCoord($data->x);
      $this->y = $this->setYCoord($data->y);
    }
  }

  public function setId(int $id)
  {
    $this->id = $id;
  }

  public function setName(string $name)
  {
    $this->name = $name;
  }

  public function setType(string $type)
  {
    if (!is_iterable($type)) {
      $this->type = $this->types[$type];
    }
    $this->type = $type;
  }

  public function setXCoord(int $x)
  {
    $this->x = $x;
  }

  public function setYCoord(int $y)
  {
    $this->y = $y;
  }
}
