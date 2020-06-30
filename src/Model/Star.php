<?php

namespace ssim\Model;

class Star {

  public $id = 0;
  public $name = false;
  public $type = null;
  public $x_coord = 0;
  public $y_coord = 0;

  public function __construct($star) {
    $this->id = $star->id;
    $this->name = $star->name;
    $this->type = $star->type;
    $this->x_coord = $star->x_coord;
    $this->y_coord = $star->y_coord;
  }

}