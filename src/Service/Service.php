<?php

namespace App\Service;

use App\Data\Payload\ActionPayload as Payload;
use App\Data\Payload\ActionErrorPayload as Error;

class Service
{

  public $payload;
  public $error;

  public function __construct(Payload $payload, Error $error)
  {
    $this->payload = $payload;
    $this->error = $error;
  }
}
