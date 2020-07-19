<?php 

namespace ssim\Controllers\Json\Ship;

use ssim\Controllers\Json\JsonController;
use ssim\Repository\Ship;

abstract class ShipController extends JsonController {

  protected $ship;

  public function __construct(Ship $ship) {
    $this->ship = $ship;
  }

}