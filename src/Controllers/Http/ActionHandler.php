<?php

namespace ssim\Controllers\Http;


class ActionHandler {

  public $db;

  public $message = null;

  public function __construct() {
    $this->messages = [];
  } 

  final public function ErrorMessage (string $text, bool $priority = false) {
    $message = new \stdclass;
    $message->text = $text;
    $message->type = 'danger';
    if($priority) unset($this->messages);
    $this->messages[] = $message;
  }

  final public function WarningMessage (string $text, bool $priority = false) {
    $message = new \stdclass;
    $message->text = $text;
    $message->type = 'warning';
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