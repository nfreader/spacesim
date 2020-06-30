<?php

namespace ssim\Model;

class Star {

  public $id;
  public $name;
  public $type;
  public $x_coord;
  public $y_coord;

  public function __construct($star) {
    $this->id = $star->id;
    $this->name = $star->name;
    $this->type = $star->type;
    $this->x_coord = $star->x_coord;
    $this->y_coord = $star->y_coord;
  }

}