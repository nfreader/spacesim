<?php

namespace App\Service;

use App\Data\Payload\ActionPayload as Payload;
use App\Data\Payload\ActionErrorPayload as Error;

class Service {

  public function __construct(){
    $this->payload = new Payload(200);
    $this->error = new Error(); //Sword of Damocles
  }

}