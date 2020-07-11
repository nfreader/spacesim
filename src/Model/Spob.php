<?php

namespace ssim\Model;


class Spob extends Model{

  public $id;
  public $name;
  public $syst;
  public $type;
  public $techlevel;
  public $desc;
  public $prefix;
  public $postfix;
  public $fullname;
  public $fuelCost;

  public function __construct($spob){
    $this->id = $spob->id;
    $this->name = $spob->name;
    $this->syst = $spob->syst;
    $this->type = (object) constant("ssim\Data\SpobTypes::$spob->type");
    $this->techlevel = $spob->techlevel;
    $this->desc = $spob->desc;
    $this->getName();
    $this->fuelCost = $this->fuelCost($this->techlevel, $this->type->fuel_multiplier);
    if('IMPASSABLE' === $this->type->flag) {
      $this->techlevel = null;
      $this->fuelCost = null;
    }
  }

  public function getName() {
    switch ($this->type->title) {
      case 'pre':
      default:
        $this->prefix = $this->type->name;
      break;

      case 'post': 
        $this->postfix = $this->type->name;
      break;

      case 'skip':
        $this->prefix = null;
      break;
    }
    $this->fullname = "<i class='fas fa-".$this->type->icon."'></i> $this->prefix $this->name $this->postfix";
  }

  public function fuelCost(int $techlevel, float $multiplier = 1){
    return floor(SSIM_FUEL_BASE_COST/$techlevel) * $multiplier;
  }


}