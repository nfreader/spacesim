<?php

namespace ssim\Repository;

use ssim\Model\Syst as SystModel;

use ParagonIE\EasyDB\EasyDB as DB;
use ssim\Notification\Flash;

use ssim\Repository\Audit;

class Syst extends Repository{

  private $filters = [
    'name' => [
      'filter' => FILTER_SANITIZE_SPECIAL_CHARS,
      'flags' => FILTER_FLAG_ENCODE_HIGH,
    ],
    'distance' => [
      'filter' => FILTER_VALIDATE_FLOAT,
      'min_range' => '.25',
      'max_range' => '10'
    ],
    'speed' => [
      'filter' => FILTER_VALIDATE_FLOAT,
      'min_range' => '.01',
    ],
    'star' => [
      'filter' => FILTER_VALIDATE_INT
    ]
  ];
  
  public function __construct(DB $db, Flash $flash, Audit $audit, Star $star) {
    $this->db = $db;
    $this->flash = $flash;
    $this->audit = $audit;
    $this->star = $star;
  }

  public function addNew($data){
    $this->data = $data;
    if(!$this->validateData()){
      return false;
    }
    if(!$star = $this->star->getStar($this->data['star'])){
      $this->flash->Error("System must be assigned to an existing star!");
      return false;
    }
    try {
      $this->db->insert('ssim_systs',$this->data);
    } catch (\PDOException $e){
      if(SSIM_DEBUG) {
        $this->flash->Error($e->getMessage().". This system was not created.");
      } else {
        $this->flash->Error("This system could not be created");
      }
      return false;
    }
    $this->audit->addNew('NEWSYST', "Added ".$this->data['name']);
  }

  public function validateData() {
    $this->data = filter_var_array($this->data, $this->filters);
    $valid = true;
    if ('' === $this->data->name) {
      $this->flash->Error("System must be named!");
      $valid = false;
    }
    if (false === $this->data->distance) {
      $this->flash->Error("Distance is required");
      $valid = false;
    }
    if (false === $this->data->speed) {
      $this->flash->Error("Speed is required");
      $valid = false;
    }
    return $valid;
  }

  public function getSysts(int $star, bool $getStar = false){
    $starid = $star;
    if(!$getStar){
      if(!$star = $this->star->getStar($star)){
        $this->flash->Error("Unable to locate star: $star");
        return false;
      }
    }
    $systs = $this->db->run("SELECT s.id, s.name, s.distance, s.speed, s.star FROM ssim_systs s WHERE s.star = ? ORDER BY s.distance ASC", $starid);
    foreach ($systs as &$syst){
      $syst->star = $star;
      $syst = new SystModel($syst);
    }
    return $systs;
  }

  public function getSyst(int $id, bool $getStar = false){
    $syst = $this->db->row("SELECT s.id, s.name, s.distance, s.speed, s.star FROM ssim_systs s WHERE s.id = ?", $id);
    if(!$syst) return false;
    if($getStar){
      $syst->star = $this->star->getStar($syst->star);
    }
    return new SystModel($syst);
  }

}