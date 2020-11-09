<?php

namespace App\Domain\Star\Service;

use App\Service\Service;
use App\Domain\Star\Repository\Star as Repo;
use App\Domain\Syst\Repository\Syst;
use App\Domain\Star\Data\Types;

final class ViewStar extends Service
{

  protected $repo;
  protected $types;

  public function __construct(Repo $repo, Syst $syst)
  {
    $this->repo = $repo;
    $this->syst = $syst;
    parent::__construct();
  }

  public function getStar(int $id)
  {
    $star = $this->repo->getStar($id);
    if (!$star) $this->payload->returnError("This star does not exist.");
    $star->setSysts($this->syst->getSysts($star->id));
    $this->payload->addData('star', $star);
    return $this->payload;
  }
  public function getStars()
  {
    $stars = $this->repo->getStars();
    $systs = $this->syst->getAllSysts();
    foreach ($stars as $s) {
      foreach ($systs as $st) {
        if ($st->star === $s->id) {
          $s->systs[] = $st;
        }
      }
    }
    $this->payload->addData('types', (new Types)->getTypes());
    $this->payload->addData('stars', $stars);
    return $this->payload;
  }
}
