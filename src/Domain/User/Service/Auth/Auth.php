<?php

namespace App\Domain\User\Service\Auth;

use App\Service\Service;
use App\Domain\User\Data\User;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Data\Permissions;
use App\Data\Payload\ActionPayload as Payload;
use App\Data\Payload\ActionErrorPayload as Error;

class Auth extends Service
{

  protected $session;

  public function __construct(Session $session, Permissions $permissions)
  {
    $this->session = $session;
    $this->permissions = $permissions;
    parent::__construct(new Payload, new Error);
  }

  public function AuthenticateUser(User $user)
  {
    $user->setPermissions($this->permissions->mapPermissionsForUser($user->id));
    $this->session->set('user', $user);
  }
}
