<?php

namespace App\Action\Star;

use App\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;
use App\Responder\Responder;
use App\Domain\Star\Service\AddStar as Star;

final class AddStar extends Action
{

  protected $template = 'star/view.twig';
  protected $error_template = 'galaxy/list.twig';

  public function __construct(Responder $responder, Star $star)
  {
    $this->star = $star;
    parent::__construct($responder);
  }

  public function action(): Response
  {
    return $this->respond($this->star->addStar($this->request->getParsedBody()));
  }
}
