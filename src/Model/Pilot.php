<?php

namespace ssim\Model;

use ssim\Data\IndieGovt;

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
  public $govt;

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
    $this->govt = $this->getGovt($pilot->govt);
    $this->vessel = null;
    $this->ship = null;
  }

  private function setLocation(){
    if(is_object($this->spob) && is_object($this->syst)) {
      return ucfirst($this->spob->type->verbs->land->past." ".$this->spob->fullname);
    } else if ($this->spob && $this->syst){
      return "$this->spob in the $this->syst system";
    }
    return "Lost in space!";
  }

  private function getGovt(?object $govt = null){
    if(!$govt){
      return new IndieGovt();
    }
  }

}