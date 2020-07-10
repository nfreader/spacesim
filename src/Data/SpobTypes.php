<?php

namespace ssim\Data;

class SpobTypes {

  public const P = [
    'short' => 'P',
    'name'  => 'Planet',
    'verbs' => [
      'land' => [
        'future' => 'land on',
        'past'   => 'landed on'
      ],
      'liftoff' => [
        'future' => 'take off from',
        'past' => 'lifted off from'
      ]
    ],
    'title' => 'pre',
    'icon' => 'globe',
    'fuel_multiplier' => 1,
  ];

  public const M = [
    'short' => 'M',
    'name'  => 'Moon',
    'verbs' => [
      'land' => [
        'future' => 'land on',
        'past'   => 'landed on'
      ],
      'liftoff' => [
        'future' => 'take off from',
        'past' => 'lifted off from'
      ]
    ],
    'title' => 'pre',
    'icon' => 'moon',
    'fuel_multiplier' => .5
  ];

  public const S = [
    'short' => 'S',
    'name'  => 'Station',
    'verbs' => [
      'land' => [
        'future' => 'dock at',
        'past'   => 'docked at'
      ],
      'liftoff' => [
        'future' => 'undock from',
        'past' => 'undocked from'
      ]
    ],
    'title' => 'post',
    'icon' => 'warehouse',
    'fuel_multiplier' => 1.5
  ];

  public const N = [
    'short' => 'N',
    'name'  => 'Un-prefixed Station',
    'verbs' => [
      'land' => [
        'future' => 'dock at',
        'past'   => 'docked at'
      ],
      'liftoff' => [
        'future' => 'undock from',
        'past' => 'undocked from'
      ]
    ],
    'title' => 'skip',
    'icon' => 'warehouse',
    'fuel_multiplier' => 1.5
  ];

  static function getTypes() {
    return (new \ReflectionClass(__CLASS__))->getConstants();
  }

}