<?php

namespace App\Action\Galaxy;

use App\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;
use App\Responder\Responder;
use App\Domain\Star\Service\ViewStar as Star;

final class ListGalaxy extends Action
{

  protected $template = 'galaxy/list.twig';

  protected $responder;
  protected $star;

  public function __construct(Responder $responder, Star $star)
  {
    parent::__construct($responder);
    $this->star = $star;
  }

  public function action(): Response
  {
    return $this->respond($this->star->getStars());
  }
}
