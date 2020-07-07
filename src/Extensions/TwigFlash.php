<?php

namespace ssim\Extensions;

class TwigFlash extends \Twig\Extension\AbstractExtension implements \Twig\Extension\GlobalsInterface {

  public function getGlobals(): array {
    return [
      'flash' => $_SESSION[SSIM_IDENT]['flash']
    ];
  }

}