<?php

namespace ssim\Controllers\Json;

use JsonSerializable;

class JsonPayload implements JsonSerializable {

  private $statusCode;
  private $data;
  private $error;

  public function __construct(int $statusCode = 200, $data = null, $error = null) {
    $this->statusCode = $statusCode;
    $this->data = $data;
    $this->error = $error;
  }

  public function jsonSerialize() {
    $payload = [
      'statusCode' => $this->statusCode
    ];
    if(null !== $this->data) {
      $payload['data'] = $this->data;
    }
    if(null !== $this->error) {
      $payload['error'] = $this->error;
    }

    return $payload;
  }

  public function getStatusCode() {
    return $this->statusCode;
  }
}