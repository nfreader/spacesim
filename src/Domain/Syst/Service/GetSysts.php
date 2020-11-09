<?php

namespace App\Domain\Syst\Service;

use App\Domain\Syst\Repository\Syst as Repo;

class GetSysts
{

  private $repo;

  public function __construct(Repo $repo)
  {
    $this->repo = $repo;
  }

  public function GetSysts(int $star)
  {
  }
}
