<?php

namespace App\Service;

use App\Data\Payload\ResponsePayload as Payload;

class Service
{

  public function __construct()
  {
    $this->payload = new Payload;
  }
}
