<?php

namespace App\Action\Syst;

use App\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;
use App\Responder\Responder;
use App\Domain\Syst\Service\AddSyst as Syst;
use App\Domain\Star\Repository\Star as Star;

final class AddSyst extends Action
{

  protected $template = 'syst/view.twig';
  protected $error_template = 'star/view.twig';

  public function __construct(Responder $responder, Syst $syst, Star $star)
  {
    $this->syst = $syst;
    $this->star = $star;
    parent::__construct($responder);
  }

  public function action(): Response
  {
    $star = $this->star->getStar($this->args['star']);
    $data = $this->request->getParsedBody();
    $data['star'] = $star->id;
    $this->payload = $this->syst->addSyst($data);
    $this->payload->addData(
      'star',
      $star
    );
    return $this->respond($this->payload);
  }
}
