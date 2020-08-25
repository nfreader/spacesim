<?php

namespace ssim\Controllers\Http\Test;

use ssim\Controllers\Http\HttpController;

use Slim\Http\Response;

use ssim\Repository\SecretKey;

use Slim\Views\Twig;


class TestController Extends HttpController {

  private $key;

  public function __construct(SecretKey $key, Twig $twig) {
    $this->key = $key;
    $this->twig = $twig;
  }

  public function action(): Response {
    $payload = [
      'template'=>'base/test.twig',
      'test' => 'Laborum ea ipsum enim culpa aliqua tempor laboris et fugiat sint velit cupidatat do sunt. Et in occaecat aute enim. Sit est ea et excepteur aute aute nisi pariatur commodo Lorem minim.',
      'key' => $this->key->getKey()
    ];
    return $this->respond($payload);
  }
}