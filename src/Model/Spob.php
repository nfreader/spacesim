<?php

namespace ssim\Model;
use ssim\Model\Model;

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

  public function __construct($spob){
    $this->id = $spob->id;
    $this->name = $spob->name;
    $this->syst = $spob->syst;
    $this->type = (object) constant("ssim\Data\SpobTypes::$spob->type");
    $this->techlevel = $spob->techlevel;
    $this->desc = $spob->desc;
    $this->getName();
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
      break;
    }
    $this->fullname = "<i class='fas fa-".$this->type->icon."'></i> $this->prefix $this->name $this->postfix";
  }


}