<?php

namespace ssim\Controllers\Json;

class JsonError implements JsonSerializable {

  public const BAD_REQUEST = 'BAD_REQUEST';
  public const INSUFFICIENT_PRIVILEGES = 'INSUFFICIENT_PRIVILEGES';
  public const NOT_ALLOWED = 'NOT_ALLOWED';
  public const NOT_IMPLEMENTED = 'NOT_IMPLEMENTED';
  public const RESOURCE_NOT_FOUND = 'RESOURCE_NOT_FOUND';
  public const SERVER_ERROR = 'SERVER_ERROR';
  public const UNAUTHENTICATED = 'UNAUTHENTICATED';
  public const VALIDATION_ERROR = 'VALIDATION_ERROR';
  public const VERIFICATION_ERROR = 'VERIFICATION_ERROR';

  
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

}