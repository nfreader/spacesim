<?php

namespace App\Domain\Syst\Service;

use App\Domain\Syst\Repository\Syst as Repo;
use App\Domain\Star\Repository\Star as Star;
use App\Domain\Spob\Data\SpobTypes;
use App\Service\Service;

class ViewSyst extends Service
{

  private $repo;
  private $star;

  public function __construct(Repo $repo, Star $star)
  {
    $this->repo = $repo;
    $this->star = $star;
    parent::__construct();
  }

  public function getSyst(int $syst)
  {
    $syst = $this->repo->getSyst($syst);
    $star = $this->star->getStar($syst->star);
    $this->payload->addData('syst', $syst);
    $this->payload->addData('star', $star);
    $this->payload->addData('spobTypes', (new SpobTypes())->getTypes());
    return $this->payload;
  }
}
