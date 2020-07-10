<?php

namespace ssim\Model;

class Syst {

  public $id;
  public $name;
  public $star;
  public $distance;
  public $speed;
  public $position;

  public function __construct($syst) {
    $this->id = $syst->id;
    $this->name = $syst->name;
    $this->star = $syst->star;
    $this->distance = $syst->distance;
    $this->speed = $syst->speed;
    $this->position = $this->calculatePosition($syst->speed);
    $this->fullname = "<i class='fas fa-circle-notch'></i> $syst->name ";
  }

  public function calculatePosition(?float $speed = null) {
    $calc = ((date('z') * $speed) / 360);
    $calc = $calc - (floor($calc));
    return $calc * 100;
  }
}