<?php

namespace App\Domain\Syst\Factory;

use App\Domain\Syst\Data\Syst;

class SystFactory
{

  public function __construct($data)
  {
    $syst = new Syst();
    $syst->setId($data->id);
    $syst->setName($data->name);
    $syst->setStar($data->star);
    $syst->setDistance($data->distance);
    $syst->setSpeed($data->speed);
    $syst->calculatePosition($data->speed);
    if ($data->govt) {
      $syst->setGovernment($data->govt);
    }
    return $syst;
  }
}
