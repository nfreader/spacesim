<?php

namespace App\Action\Galaxy;

use App\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;
use App\Domain\Star\Data\Types;

final class ListGalaxy extends Action
{

  protected $template = 'galaxy/list.twig';

  public function __construct(Twig $twig)
  {
    $this->twig = $twig;
    parent::__construct($twig);
  }

  public function action(): Response
  {
    // var_dump($this->payload);
    $this->payload->addData('types', (new Types)->getTypes());
    return $this->respond($this->payload);
  }
}
