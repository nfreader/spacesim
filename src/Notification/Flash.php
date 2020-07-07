<?php

namespace ssim\Notification;

class Flash {

  public function __construct(){
  }

  public function Success(string $text) {
    $message = new \stdclass;
    $message->text = $text;
    $message->type = 'success';
    $_SESSION[SSIM_IDENT]['flash'][] = $message;
  }

}