<?php

namespace App\Action;

use App\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;

final class Index extends Action
{

  protected $template = 'home/home.twig';

  public function action(): Response
  {
    return $this->respond();
  }
}
