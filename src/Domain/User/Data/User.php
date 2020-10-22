<?php

namespace App\Domain\User\Data;

class User
{

  public $id;
  public $email;
  public $displayName;
  public $status;
  public $service = 'internal';
  public $permissions = [];

  public function __construct()
  {
  }

  public function setId(int $id)
  {
    $this->id = $id;
  }

  public function setEmail(string $email)
  {
    $this->email = $email;
  }

  public function setDisplayName(string $displayName)
  {
    $this->displayName = $displayName;
  }

  public function setStatus(bool $status)
  {
    $this->status = $status;
  }

  public function setService(string $service)
  {
    $this->service = $service;
  }

  public function setPermissions(array $perms)
  {
    $this->permissions = $perms;
  }

  public function hasPermission($permission)
  {
    if (
      $this->permissions
      && isset($this->permissions[$permission])
      && $this->permissions[$permission] === true
    ) return true;
    return false;
  }
}
