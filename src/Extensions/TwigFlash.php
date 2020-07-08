<?php

namespace ssim\Extensions;

class TwigFlash extends \Twig\Extension\AbstractExtension implements \Twig\Extension\GlobalsInterface {

  public function getGlobals(): array {
    $flash = $_SESSION[SSIM_IDENT]['flash'];
    $_SESSION[SSIM_IDENT]['flash'] = [];
    return [
      'flash' => $flash
    ];
  }

}