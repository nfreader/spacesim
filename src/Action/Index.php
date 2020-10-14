<?php

namespace App\Action;

use App\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;

final class Index extends Action
{

  protected $template = 'home/home.twig';

  public function __construct(Twig $twig) {
    $this->twig = $twig;
    parent::__construct($twig);
  }

  public function action(): Response {
    return $this->respond();
  }

}