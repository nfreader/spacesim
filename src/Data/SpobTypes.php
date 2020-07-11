<?php

namespace ssim\Data;

class SpobTypes {

  public const P = [
    'short' => 'P',
    'name'  => 'Planet',
    'backend_name' => 'Normal Planet',
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
    'backend_name' => 'Normal Moon',
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
    'backend_name' => 'Normal Station',
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
    'name'  => 'Station',
    'backend_name' => 'Un-prefixed Station',
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
    'title' => 'skip',
    'icon' => 'warehouse',
    'fuel_multiplier' => 1.5
  ];

  public const I = [
    'short' => 'I',
    'name'  => 'Planet',
    'backend_name' => 'Inhospitable Planet',
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
    'icon' => 'skull-crossbones',
    'fuel_multiplier' => 2000,
    'flag' => 'IMPASSABLE'
  ];

  static function getTypes() {
    return (new \ReflectionClass(__CLASS__))->getConstants();
  }

}