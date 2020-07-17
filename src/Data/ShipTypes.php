<?php

namespace ssim\Data;

class ShipTypes {

  const S = [
    'name' => 'Shuttle',
    'IFF' => 'CS',
    'long' => 'Cargo Shuttle'
  ];

  const F = [
    'name' => 'Fighter',
    'IFF' => 'FS',
    'long' => 'Fighter Craft'
  ];

  static function getTypes() {
    return (new \ReflectionClass(__CLASS__))->getConstants();
  }

}