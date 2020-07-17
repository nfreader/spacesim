<?php

namespace ssim\Repository;

use ParagonIE\EasyDB\EasyDB as DB;

use ssim\Notification\Flash;
use ssim\Repository\Audit;
use ssim\Repository\Repository;

use ssim\Model\Ship as ShipModel;

class Ship extends Repository {

  public $filters = [
    'name' => [
      'filter' => FILTER_SANITIZE_STRING,
      'flags' => FILTER_FLAG_STRIP_HIGH,
    ],
    'shipwright' => [
      'filter' => FILTER_SANITIZE_STRING,
      'flags' => FILTER_FLAG_STRIP_HIGH,
    ],
    'fueltank' => [
      'filter' => FILTER_VALIDATE_INT,
      'options' => [
        'min_range' => 0,
      ]
    ],
    'cargobay' => [
      'filter' => FILTER_VALIDATE_INT,
      'options' => [
        'min_range' => 1,
      ]
    ],
    'expansion' => [
      'filter' => FILTER_VALIDATE_INT,
      'options' => [
        'min_range' => 1,
      ]
    ],
    'accel' => [
      'filter' => FILTER_VALIDATE_INT,
      'options' => [
        'min_range' => 1,
      ]
    ],
    'turn' => [
      'filter' => FILTER_VALIDATE_INT,
      'options' => [
        'min_range' => 1,
      ]
    ],
    'mass' => [
      'filter' => FILTER_VALIDATE_INT,
      'options' => [
        'min_range' => 1,
      ]
    ],
    'armor' => [
      'filter' => FILTER_VALIDATE_INT,
      'options' => [
        'min_range' => 1,
      ]
    ],
    'shields' => [
      'filter' => FILTER_VALIDATE_INT,
      'options' => [
        'min_range' => 1,
      ]
    ],
    'class' => [
      'filter' => FILTER_SANITIZE_STRING,
      'flags' => FILTER_FLAG_STRIP_HIGH,
    ],
    'cost' => [
      'filter' => FILTER_VALIDATE_INT,
      'options' => [
        'min_range' => 1,
      ]
    ],
    'desc' => [
      'filter' => FILTER_SANITIZE_STRING,
      'flags' => FILTER_FLAG_STRIP_HIGH,
    ],
    'starter' => [
      'filter' => FILTER_VALIDATE_BOOLEAN
    ]
  ];

  protected const TABLE = 'ssim_ships';

  protected $data;

  protected $db;
  protected $flash;
  protected $audit;

  public function __construct(DB $db, Flash $flash, Audit $audit) {
    $this->db = $db;
    $this->flash = $flash;
    $this->audit = $audit;
  }

  public function getShipyard() {
    $ships = $this->db->run("SELECT s.id, 
    s.name,
    s.shipwright,
    s.fueltank,
    s.cargobay,
    s.expansion,
    s.accel,
    s.turn,
    s.mass,
    s.shields,
    s.armor,
    s.class,
    s.cost,
    s.desc,
    s.starter
    FROM ssim_ships s");
    foreach ($ships as &$ship){
      $ship = new ShipModel($ship);
    }
    return $ships;
  }

  public function addNew($data) {
    $this->data = $data;
    if(!$this->validateData()) return false;
    try {
      $this->db->insert(static::TABLE, (array) $this->data);
    } catch (\PDOException $e){
      if(SSIM_DEBUG) {
        $this->flash->Error($e->getMessage().". This ship was not created.");
      } else {
        $this->flash->Error("This ship could not be created");
      }
      return $this->data;
    }
    $this->flash->Success("Your ship was created!");
    $this->audit->addNew('NEWSHIP', "Created ".$this->data->name);

  }

  private function validateData(){
    $this->data = filter_var_array($this->data, $this->filters);
    $this->data = (object) $this->data;
    $valid = true;
    if ('' === $this->data->name) {
      $this->flash->Error("Ship must be named!");
      $valid = false;
    }
    if ('' === $this->data->shipwright) {
      $this->flash->Error("Ship must have a shipwright!");
      $valid = false;
    }
    if ('' === $this->data->type) {
      $this->flash->Error("Ship type is not defined!");
      $valid = false;
    }
    return $valid;
  }

}