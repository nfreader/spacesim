<?php

namespace ssim\Aggregate;

use ssim\Repository\Star;
use ssim\Repository\Syst;
use ssim\Repository\Spob;

class Galaxy {

  protected $star;
  protected $syst;
  protected $sbob;

  public function __construct(Star $star, Syst $syst, Spob $spob) {
    $this->star = $star;
    $this->syst = $syst;
    $this->spob = $spob;
  }

  public function getGalaxy(){
    $stars = $this->star->getStars();
    foreach ($stars as &$star){
      $star->systs = $this->syst->getSysts($star->id, TRUE);
      foreach($star->systs as &$syst) {
        $syst->spobs = $this->spob->getSpobs($syst->id);
      }
    }
    return $stars;
  }

}