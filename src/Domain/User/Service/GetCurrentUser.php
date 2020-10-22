<?php

namespace App\Domain\User\Service;

use App\Service\Service;
use App\Domain\User\Repository\UserRepository as Repo;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Data\Permissions;

final class GetCurrentUser extends Service
{

  protected $repo;
  protected $session;
  protected $permissions;

  public function __construct(Repo $repo, Session $session, Permissions $permissions)
  {
    $this->repo = $repo;
    $this->session = $session;
    $this->permissions = $permissions;
  }

  public function GetCurrentUser()
  {
    if ($user = $this->session->get('user')) {
      $user->setPermissions($this->permissions->mapPermissionsForUser($user->id));
      $this->session->set('user', $user);
    }
  }
}
