<?php

namespace ssim\Notification;

class Flash {

  public function __construct(){
    
  }

  private function addMessage(
    string $text = 'This is a message', 
    string $level = 'info',
    int $code = 200) {
    $message = new \stdclass;
    $message->text = $text;
    $message->type = $level;
    $message->code = $code;
    $_SESSION[SSIM_IDENT]['flash'][] = $message;
  }

  public function Success(string $text = 'This is a success message') {
    $this->addMessage($text, 'success');
  }

  public function Info(string $text = 'This is an info message') {
    $this->addMessage($text, 'info');
  }

  public function Warning(string $text = 'This is a warning message') {
    $this->addMessage($text, 'warning');
  }

  public function Error(
    string $text = 'This is an error message',
    int $code = 500) {
    $this->addMessage($text, 'danger', $code);
  }

}