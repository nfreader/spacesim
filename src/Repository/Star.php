<?php

namespace ssim\Repository;

// use ParagonIE\EasyDB\EasyDB as DB;

use ssim\Model\Star as StarModel;

use ParagonIE\EasyDB\EasyDB as DB;
use ssim\Notification\Flash;

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
  
  public function __construct(DB $db, Flash $flash) {
    $this->db = $db;
    $this->flash = $flash;
  }

  public function addNew(array $data) {
    $this->flash->Success("Test");
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