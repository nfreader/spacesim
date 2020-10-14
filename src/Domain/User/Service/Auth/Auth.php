<?php

namespace App\Domain\User\Service\Auth;

use App\Service\Service;
use Symfony\Component\HttpFoundation\Session\Session;

class Auth extends Service{

  protected $session;

  public function __construct(Session $session) {
    $this->session = $session;
    parent::__construct();
  }

}