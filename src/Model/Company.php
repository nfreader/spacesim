<?php

namespace ssim\Model;

class Company {

  public $id;
  public $name;
  public $homeworld;

  public function __construct(?object $company = null) {
    if(!$company) return false;
    $this->id = $company->id;
    $this->name = $company->name;
    $this->homeworld = $company->homeworld;
  }
}