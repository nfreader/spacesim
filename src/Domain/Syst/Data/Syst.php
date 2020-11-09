<?php

namespace App\Domain\Syst\Data;

use App\Domain\Government\Data\IndieGovt;

class Syst
{
  public int $id;
  public string $name;
  public $star;
  public float $distance;
  public float $speed;
  public float $position;
  public $govt;

  public function __construct(object $data = null)
  {
    if ($data) {
      $this->setId($data->id);
      $this->setName($data->name);
      $this->setStar($data->star);
      $this->setDistance($data->distance);
      $this->setSpeed($data->speed);
      $this->calculatePosition($data->speed);
      $this->setGovernment(null);
      if ($data->govt) {
        $this->setGovernment($data->govt);
      }
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

  public function setStar($star)
  {
    $this->star = $star;
  }

  public function setDistance(float $distance)
  {
    $this->distance = $distance;
  }

  public function setSpeed(float $speed)
  {
    $this->speed = $speed;
  }

  public function calculatePosition(float $speed)
  {
    $calc = ((date('z') * $speed) / 360);
    $calc = $calc - (floor($calc));
    $this->position = $calc * 100;
  }

  public function setGovernment($govt)
  {
    if (!$govt) {
      $this->govt = new IndieGovt();
    }
  }
}
