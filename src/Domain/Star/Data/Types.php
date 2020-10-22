<?php

namespace App\Domain\Star\Data;

class Types
{

  public const R = [
    'short' => 'R',
    'name' => 'Red Dwarf',
    'article' => 'a'
  ];
  public const H = [
    'short' => 'H',
    'name' => 'H-Type Star',
    'article' => 'an'
  ];
  public const M = [
    'short' => 'M',
    'name' => 'M-Type Star',
    'article' => 'an'
  ];
  public const P = [
    'short' => 'P',
    'name' => 'Pulsar',
    'article' => 'a'
  ];
  public const S = [
    'short' => 'S',
    'name' => 'Singularity',
    'article' => 'an'
  ];

  static function getTypes()
  {
    return (new \ReflectionClass(__CLASS__))->getConstants();
  }
}
