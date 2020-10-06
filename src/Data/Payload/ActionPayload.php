<?php

namespace App\Data\Payload;

class ActionPayload {

  protected $statusCode = 200;
  public $data = [];
  protected $error = false;

  private $messages = [];

  public function __construct(int $statusCode = 200, $data = [], $error = false) {
    $this->statusCode = $statusCode;
    $this->data = (object) $data;
    $this->error = $error;
  }

  public function getStatusCode(){
    return $this->statusCode;
  }

  public function getData($convert = true){
    if(is_array($this->data)) $this->data['messages'] = $this->messages;
    if(is_object($this->data)) $this->data->messages = $this->messages;
    if($convert) return (array) $this->data;
    return $this->data;
  }

  public function getError(){
    return $this->error;
  }

  final public function ErrorMessage (string $text, bool $priority = false) {
    $message = new \stdclass;
    $message->text = $text;
    $message->type = 'danger';
    if($priority) unset($this->messages);
    $this->messages[] = $message;
  }

  final public function Message (string $text, bool $priority = false) {
    $message = new \stdclass;
    $message->text = $text;
    $message->type = 'info';
    if($priority) unset($this->messages);
    $this->messages[] = $message;
  }

 final public function SuccessMessage (string $text, bool $priority = false) {
    $message = new \stdclass;
    $message->text = $text;
    $message->type = 'success';
    if($priority) unset($this->messages);
    $this->messages[] = $message;
  }

}