<?php

namespace App\Action\Galaxy;

use App\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;
use App\Domain\Star\Data\Types;
use App\Domain\Star\Repository\Star;

final class ListGalaxy extends Action
{

  protected $template = 'galaxy/list.twig';
  protected $twig;
  protected $star;
  public function __construct(Twig $twig, Star $star)
  {
    $this->star = $star;
    parent::__construct($twig);
  }

  public function action(): Response
  {
    $this->payload->addData('types', (new Types)->getTypes());
    $this->payload->addData('stars', $this->star->getStars());
    return $this->respond($this->payload);
  }
}
