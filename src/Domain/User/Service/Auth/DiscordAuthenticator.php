<?php

namespace App\Domain\User\Service\Auth;

use App\Service\Service;
use App\Domain\User\Service\Auth\Auth;
use App\Provider\DiscordAuthProvider as Provider;
use App\Domain\User\Repository\ExternalUser as Repo;
use Symfony\Component\HttpFoundation\Session\Session;

final class DiscordAuthenticator extends Auth {

  private $provider;
  protected $session;
  private $repo;

  public function __construct(Provider $provider, Session $session, Repo $repo){
    $this->provider = $provider;
    $this->repo = $repo;
    parent::__construct($session);
  }

  public function makeOAuthRequest() {
    return $this->provider->generateOAuthRequest();
  }

  public function AuthenticateFromDiscord($code){
    $code = filter_var($code, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
    $this->session->invalidate();
    $this->session->start();
    $this->session->set('discord_code', $code);
    $user = $this->provider->getDiscordUser($code);
    $this->session->set('discord_user', $user);
    $this->repo->AddAccount($user, 'discord');
  }

}