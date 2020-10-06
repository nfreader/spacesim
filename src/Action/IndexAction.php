<?php

namespace App\Action;

use App\Action\ActionHandler;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;

final class IndexAction extends ActionHandler
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