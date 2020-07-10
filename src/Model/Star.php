<?php

namespace ssim\Model;

use ssim\Data\StarTypes;

class Star {

  public $id;
  public $name;
  public $type = [];
  public $x;
  public $y;
  public $systs = [];

  public function __construct($star) {
    $this->id = $star->id;
    $this->name = $star->name;
    $this->type = constant("ssim\Data\StarTypes::$star->type");
    $this->x = $star->x;
    $this->y = $star->y;
    $this->systs = $star->systs;
    $this->fullname = '<i class="fas fa-circle-notch"></i> '.$this->name;
  }

}