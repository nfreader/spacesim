<?php

namespace App\Action\Star;

use App\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;
use App\Domain\Star\Repository\Star as Star;

final class ViewStar extends Action
{

  protected $template = 'star/view.twig';
  protected $error_template = 'galaxy/list.twig';

  public function __construct(Twig $twig, Star $star)
  {
    $this->twig = $twig;
    $this->star = $star;
    parent::__construct($twig);
  }

  public function action(): Response
  {
    $this->payload->addData('star', $this->star->getStar($this->args['id']));
    return $this->respond($this->payload);
  }
}
