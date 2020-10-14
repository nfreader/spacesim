<?php

namespace App\Provider;

class DiscordAuthProvider {

  public function __construct($settings) {
    $this->settings = $settings;
  }

  public function generateOAuthRequest(){
    $params = array(
      'client_id' => $this->settings['OAUTH2_CLIENT_ID'],
      'redirect_uri' => 'http://localhost:8000/login/discord',
      'response_type' => 'code',
      'scope' => 'identify'
    );
    return 'https://discordapp.com/api/oauth2/authorize' . '?' . http_build_query($params);
  }

}