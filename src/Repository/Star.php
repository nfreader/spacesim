<?php

namespace ssim\Repository;

// use ParagonIE\EasyDB\EasyDB as DB;

use ssim\Model\Star as StarModel;

use ParagonIE\EasyDB\EasyDB as DB;
use ssim\Notification\Flash;

use ssim\Repository\Audit;

use ssim\Data\StarTypes;

class Star extends Repository{

  
  private $filters = [
    'name' => [
      'filter' => FILTER_SANITIZE_SPECIAL_CHARS,
      'flags' => FILTER_FLAG_ENCODE_HIGH,
    ],
    'type' => [
      'filter' => FILTER_SANITIZE_STRING,
      'flags' => FILTER_FLAG_STRIP_LOW,
    ],
    'x' => [
      'filter' => FILTER_VALIDATE_INT,
      'options' => [
        'min_range' => -256,
        'max_range' => 256
      ]
    ],
    'y' => [
      'filter' => FILTER_VALIDATE_INT,
      'options' => [
        'min_range' => -256,
        'max_range' => 256
      ]
    ],
  ];
  
  public function __construct(DB $db, Flash $flash, Audit $audit) {
    $this->db = $db;
    $this->flash = $flash;
    $this->audit = $audit;

    $this->types = (new StarTypes())->getTypes();
  }

  public function getGalaxy() {
    $galaxy = $this->db->run("SELECT s.id, s.name, s.x, s.y, s.type FROM ssim_stars s");
    foreach($galaxy as &$star) {
      $star = new StarModel($star);
    }
    return $galaxy;
  }

  public function getStar(int $id) {
    if($star = $this->db->row("SELECT s.id, s.name, s.x, s.y, s.type FROM ssim_stars s WHERE s.id = ?", $id)){
      return new StarModel($star);
    }
    $this->flash->Error("No star found with id: $id");
    return false;
  }

  public function addNew(array $data) {
    $this->data = $data;
    if(!$this->validateData()){
      return false;
    }
    try {
      $this->db->insert('ssim_stars',$this->data);
    } catch (\PDOException $e){
      if(SSIM_DEBUG) {
        $this->flash->Error($e->getMessage().". This star was not created.");
      } else {
        $this->flash->Error("This star could not be created");
      }
      return false;
    }
    $this->audit->addNew('NEWSTAR', "Added ".$this->data['name']);
  }

  public function validateData(){
    $this->data = filter_var_array($this->data, $this->filters);
    var_dump($this->data);
    $valid = true;
    if ('' === $this->data->name) {
      $this->flash->Error("Star must be named!");
      $valid = false;
    }
    if ('' === $this->data->type) {
      $this->flash->Error("Star type is not defined!");
      $valid = false;
    }
    if (false === $this->data->x || false === $this->data->y) {
      $this->flash->Error("Coordinates are not defined");
      $valid = false;
    }
    return $valid;
  }

}