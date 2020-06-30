<?php

namespace ssim\Repository;

use ParagonIE\EasyDB\EasyDB as DB;

use ssim\Model\Star as StarModel;

class Star {

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
  
  public function __construct(DB $db) {
    $this->db = $db;
  }

  public function addNew(array $data) {
    $this->data = $data;
    if(!$this->validateData()){
      return false;
    }
  }

  public function validateData(){
    $this->data = filter_var_array($this->data, $this->filters);
    var_dump($this->data);
  }

}