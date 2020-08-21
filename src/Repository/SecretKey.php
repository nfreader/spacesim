<?php

namespace ssim\Repository;

use Selective\Config\Configuration as Config;
use InvalidArgumentException;

use ParagonIE\Paseto\Keys\SymmetricKey;

class SecretKey {

  protected $config;

  public $key;

  public function __construct(Config $config) {
    $this->config = $config;
    $this->key = $this->setKey();
  }

  public function getKey() {
    return $this->key;
  }

  private function setKey(){
    $key = $this->config->getString('secret_key');
    if('' === $key){
      return $this->generateKey();
    }
    return $key;
  }

  private function generateKey(){
    $key = new SymmetricKey(random_bytes(64));
    $key = base64_encode($key->raw());
    $def = "define('SSIM_SECRET_KEY','%s');";
    $def = sprintf($def, $key);
    $file = fopen(__DIR__.'/../../app/config/constants.php','a');
    if(FALSE === SSIM_SECRET_KEY) fwrite($file, $def);
    fclose($file);
    return $key;
  }

}