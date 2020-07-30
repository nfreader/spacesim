<?php

namespace ssim\Repository;

use Selective\Config\Configuration;

class Game {

  protected $config;

  private $data;

  public function __construct(Configuration $config) {
    $this->config = $config;
    $this->data = $this->getGameSettings();
  }

  private function getGameSettings(){
    return $this->config->getArray('game');
  }

  public function info() {
    return $this->data;
  }

  public function getTime() {
    return $this->data['date'];
  }

}