<?php

namespace App\Action\Syst;

use App\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;
use App\Responder\Responder;
use App\Domain\Syst\Service\ViewSyst as Syst;

final class ViewSyst extends Action
{

  protected $template = 'syst/view.twig';

  public function __construct(Responder $responder, Syst $syst)
  {
    $this->syst = $syst;
    parent::__construct($responder);
  }

  public function action(): Response
  {
    $syst = $this->syst->getSyst($this->args['syst']);
    return $this->respond($syst);
  }
}
