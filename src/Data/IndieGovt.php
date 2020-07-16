<?php

namespace ssim\Data;

use ssim\Data\GovtTypes;

class IndieGovt {

  public $name = "Independent Pilots";
  public $isoname = "IND";
  public $shortname = "Independent";
  public $color = "#AAAAAA";
  public $color2 = "#333333";
  public $type;

  public function __construct() {
    $this->type = (object) constant("ssim\Data\GovtTypes::I");
  }

}