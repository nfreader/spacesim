<?php

namespace ssim\Data;

class StarTypes {

  public const R = "Red Dwarf"; //Very common
  public const H = "H-Type Star"; //Ex. Sol.
  public const M = "M-Type Star"; //Ex. Proxima Centauri
  public const P = "Pulsar"; //Very rare
  public const S = "Singularity"; //Oh no, a singularity

  static function getTypes() {
    return (new \ReflectionClass(__CLASS__))->getConstants();
  }

}