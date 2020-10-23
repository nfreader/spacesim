<?php

namespace App\Domain\User\Service;

use App\Service\Service;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Data\Permissions;

final class GetCurrentUser extends Service
{

  protected $repo;
  protected $session;
  protected $permissions;

  public function __construct(Session $session, Permissions $permissions)
  {
    if ($user = $session->get('user')) {
      $user->setPermissions($permissions->mapPermissionsForUser($user->id));
      $session->set('user', $user);
      return $user;
    }
  }
}
