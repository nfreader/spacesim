<?php

namespace ssim\Model;

class Pilot {

  public $id;
  public $name;
  public $user;
  public $company;
  public $credits;
  public $legal;
  public $fingerprit;
  public $location;
  public $star;
  public $syst;
  public $spob;

  public function __construct($pilot){
    $this->id = $pilot->id;
    $this->name = $pilot->name;
    $this->user = $pilot->user;
    $this->company = $pilot->company;
    $this->credits = $pilot->credits;
    $this->legal = $pilot->legal;
    $this->fingerprit = $pilot->fingerprint;
    $this->star = $pilot->star;
    $this->syst = $pilot->syst;
    $this->spob = $pilot->spob;
    $this->location = $this->setLocation();
  }

  private function setLocation(){
    if(!$syst && !$spob){
      return "Lost in space!";
    }
  }

}