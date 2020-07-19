<?php

namespace ssim\Model;

class Ship {

  public $id;
  public $name;
  public $shipwright;
  public $fueltank;
  public $cargobay;
  public $expansion;
  public $accel;
  public $turn;
  public $mass;
  public $shields;
  public $armor;
  public $class;
  public $cost;
  public $desc;
  public $starter;

  public function __construct($ship) {
    $this->id = $ship->id;
    $this->name = $ship->name;
    $this->shipwright = $ship->shipwright;
    $this->fueltank = $ship->fueltank;
    $this->cargobay = $ship->cargobay;
    $this->expansion = $ship->expansion;
    $this->accel = $ship->accel;
    $this->turn = $ship->accel;
    $this->mass = $ship->mass;
    $this->shields = $ship->shields;
    $this->armor = $ship->armor;
    $this->class = json_decode(json_encode(constant("ssim\Data\ShipTypes::$ship->class")));
    $this->cost = number_format($ship->cost);
    $this->desc = $ship->desc;
    $this->starter = (bool) $ship->starter;
  }

}