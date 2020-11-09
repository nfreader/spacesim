<?php

namespace App\Action\Spob;

use App\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;
use App\Responder\Responder;

use App\Domain\Spob\Service\AddSpob as Spob;

final class AddSpob extends Action
{
  protected $template = 'spob/view.twig';
  protected $error_template = 'syst/view.twig';

  private $spob;

  public function __construct(Responder $responder, Spob $spob)
  {
    $this->spob = $spob;
    parent::__construct($responder);
  }

  public function action(): Response
  {
    return $this->response($this->payload);
  }
}
