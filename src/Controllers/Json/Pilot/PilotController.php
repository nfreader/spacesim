<?php 

namespace ssim\Controllers\Json\Pilot;

use ssim\Controllers\Json\JsonController;
use ssim\Repository\Pilot;

abstract class PilotController extends JsonController {

  protected $pilot;

  public function __construct(Pilot $pilot) {
    $this->pilot = $pilot;
  }

}