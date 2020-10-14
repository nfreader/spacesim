<?php

namespace App\Domain\User\Service\Auth;

use App\Service\Service;
use App\Domain\User\Service\Auth\Auth;
use App\Provider\DiscordAuthProvider as Provider;
use Symfony\Component\HttpFoundation\Session\Session;

final class DiscordAuthenticator extends Auth {

  private $provider;

  public function __construct(Provider $provider, Session $session){
    $this->provider = $provider;
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
  }

}