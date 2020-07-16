<?php

namespace ssim\Repository;

use ParagonIE\EasyDB\EasyDB as DB;
use ssim\Notification\Flash;
use ssim\Repository\Audit;
use ssim\Repository\Syst;
use ssim\Data\SpobTypes;
use ssim\Model\Spob as SpobModel;

class Spob {

  protected $db;
  protected $flash;
  protected $audit;
  protected $syst;

  private $filters = [
    'name' => [
      'filter' => FILTER_SANITIZE_SPECIAL_CHARS,
      'flags' => FILTER_FLAG_ENCODE_HIGH,
    ],
    'type' => [
      'filter' => FILTER_SANITIZE_STRING,
      'flags' => FILTER_FLAG_STRIP_LOW,
    ],
    'techlevel' => [
      'filter' => FILTER_VALIDATE_INT,
      'options' => [
        'min_range' => 1,
        'max_range' => 10,
        'default' => 1
      ]
    ],
    'syst' => [
      'filter' => FILTER_VALIDATE_INT,
      'options' => [
        'min_range' => 1,
      ]
    ],
    'star' => [
      'filter' => FILTER_VALIDATE_INT,
      'options' => [
        'min_range' => 1,
      ]
    ],
    'desc' => [
      'filter' => FILTER_SANITIZE_SPECIAL_CHARS,
      'flags' => FILTER_FLAG_ENCODE_HIGH
    ]
  ];

  private $data = [];

  public function __construct(DB $db, Flash $flash, Audit $audit, Syst $syst){
    $this->db = $db;
    $this->flash = $flash;
    $this->audit = $audit;
    $this->syst = $syst;
    $this->types = (new SpobTypes())->getTypes();
  }

  public function getSpobs(int $syst) {
    $spobs = $this->db->run("SELECT s.id, s.name, s.syst, s.techlevel, s.type, s.desc FROM ssim_spobs s WHERE s.syst = ?", $syst);
    foreach ($spobs as &$spob) {
      $spob = new SpobModel($spob);
    }
    return $spobs;
  }

  public function getSpob(int $id) {
    $spob = $this->db->row("SELECT s.id, s.name, s.syst, s.techlevel, s.type, s.desc FROM ssim_spobs s WHERE s.id = ?", $id);
    return new SpobModel($spob);
  }

  public function addNew($data) {
    $this->data = $data;
    if(!$this->validateData()){
      return false;
    }
    if(!$this->types[$this->data['type']]) {
      $this->flash->Error("Invalid spob type");
      return false;
    }
    if(!$this->syst->getSyst($this->data['syst'])){
      $this->flash->Error("Invalid parent system");
      return false;
    }
    unset($this->data['star']);
    try {
      $this->db->insert('ssim_spobs',$this->data);
    } catch (\PDOException $e){
      if(SSIM_DEBUG) {
        $this->flash->Error($e->getMessage().". This spob was not created.");
      } else {
        $this->flash->Error("This spob could not be created");
      }
      return false;
    }
    $this->audit->addNew('NEWSPOB', "Created ".$this->data['name']);
  }

  private function validateData(){
    $this->data = filter_var_array($this->data, $this->filters);
    $valid = true;
    if ('' === $this->data->name) {
      $this->flash->Error("Port must be named!");
      $valid = false;
    }
    if ('' === $this->data->type) {
      $this->flash->Error("Port type is not defined!");
      $valid = false;
    }
    return $valid;
  }
}