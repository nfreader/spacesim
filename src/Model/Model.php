<?php

namespace ssim\Model;

use Selective\Config\Configuration as Config;

class Model {

  protected $config;

  public function __constuct(Config $config) {
    $this->config = $config;
  }

}