<?php

namespace ssim\Aggregate;

use ssim\Repository\User;
use ssim\Repository\Company;

class AggregateUser {

  protected $user;
  protected $company;

  public function __construct(User $user, Company $company) {
    $this->user = $user;
    $this->company = $company;
  }

  public function getUser(){
    $user = $this->user->currentUser;
    if(!$user) return false;
    $user->company = $this->company->getUserCompany($user->getId());
    return $user;
  }

}