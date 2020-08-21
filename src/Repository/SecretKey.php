<?php
declare(strict_types=1);
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

  public function getKey(): string {
    return $this->key;
  }

  private function setKey(): string{
    $key = $this->config->getString('secret_key');
    if('' === $key){
      return $this->generateKey();
    }
    return $key;
  }

  private function generateKey(): string{
    $key = new SymmetricKey(random_bytes(64));
    $key = base64_encode($key->raw());
    $def = "define('SSIM_SECRET_KEY','%s');";
    $def = sprintf($def, $key);
    //This try/catch block is superfluous, because the application won't even
    //start if it can't find the constants file.
    try {
      $file = fopen(__DIR__.'/../../app/config/constants.php','a');
      if(FALSE === SSIM_SECRET_KEY) fwrite($file, $def);
      fclose($file);
    } catch (Exception $e) {
      die($e->getMessage());
    }
    return $key;
  }

}