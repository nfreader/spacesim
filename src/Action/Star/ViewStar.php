<?php

namespace App\Action\Star;

use App\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;
use App\Responder\Responder;
use App\Domain\Star\Service\ViewStar as Star;
use App\Domain\Syst\Service\GetSystsForStar;

final class ViewStar extends Action
{

  protected $template = 'star/view.twig';

  public function __construct(Responder $responder, Star $star)
  {
    $this->star = $star;
    parent::__construct($responder);
  }

  public function action(): Response
  {
    $star = $this->star->getStar($this->args['star']);
    return $this->respond($star);
  }
}
