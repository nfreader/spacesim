<?php

namespace ssim\Data;

class StarTypes {

  const H = "H-Type Star"; //Ex. Sol.
  const M = "M-Type Star"; //Ex. Proxima Centauri
  const R = "Red Dwarf"; //Very common
  const P = "Pulsar"; //Very rare
  const S = "Singularity"; //Oh no, a singularity

  static function getTypes() {
    $oClass = new ReflectionClass(__CLASS__);
    return $oClass->getConstants();
  }

}