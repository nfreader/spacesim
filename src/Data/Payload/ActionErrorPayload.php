<?php

namespace App\Data\Payload;

class ActionErrorPayload {

  protected $statusCode = 200;
  public $data = [];
  protected $error = false;

  public $messages = [];

  public function __construct(string $message = null) {
    if($message) $this->messages[] = $message;
  }

  public function getStatusCode(){
    return $this->statusCode;
  }

  public function getMessages(){
    return $this->messages;
  }

  public function addMessage(string $message){
    $this->messages[] = $message;
  }

}