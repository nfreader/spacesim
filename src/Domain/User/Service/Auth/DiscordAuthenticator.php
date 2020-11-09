<?php

namespace App\Domain\User\Service\Auth;

use App\Domain\User\Service\Auth\Auth;
use App\Provider\DiscordAuthProvider as Provider;
use App\Domain\User\Repository\ExternalUser as Repo;
use App\Domain\User\Data\User;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Data\Permissions;

final class DiscordAuthenticator extends Auth
{

  private $provider;
  protected $session;
  private $repo;
  protected $permissions;

  protected const SERVICE = 'discord';

  public function __construct(Provider $provider, Session $session, Repo $repo, Permissions $permissions)
  {
    $this->provider = $provider;
    $this->repo = $repo;
    parent::__construct($session, $permissions);
  }

  public function makeOAuthRequest()
  {
    $this->payload->redirect = $this->provider->generateOAuthRequest();
    return $this->payload;
  }

  public function AuthenticateFromDiscord(string $code)
  {
    $code = filter_var($code, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
    $this->session->invalidate();
    $this->session->start();
    $this->session->set('discord_code', $code);
    $user = $this->provider->getDiscordUser($code);
    $user = $this->ProvideAppUser($user, self::SERVICE);
    $user->id = $this->repo->AddAccount($user, self::SERVICE);
    $this->AuthenticateUser($user);
    $this->payload->addData('user', $user);
    $this->payload->SuccessMessage("You have successfully authenticated via Discord as $user->displayName");
    return $this->payload;
  }

  public function DiscordLogout()
  {
    $this->session->invalidate();
    $this->session->start();
    $this->session->getFlashBag()->add(
      'success',
      "You have been logged out"
    );
    $this->payload->redirect = 'home';
    return $this->payload;
  }

  private function ProvideAppUser(object $data, string $service = 'internal')
  {
    $user = new User();
    $user->setId($data->id);
    $user->setEmail($data->email);
    $user->setDisplayName("$data->username#$data->discriminator");
    $user->setService(self::SERVICE);
    $user->setStatus(true);
    $user->setPermissions($this->permissions->mapPermissionsForUser($data->id));
    return $user;
  }
}
