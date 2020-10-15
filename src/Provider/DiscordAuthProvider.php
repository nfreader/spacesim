<?php

namespace App\Provider;

class DiscordAuthProvider {

  private $settings;
  private $guzzle;

  public function __construct($settings, $guzzle) {
    $this->settings = $settings;
    $this->guzzle = $guzzle;
  }

  public function generateOAuthRequest(){
    $params = array(
      'client_id' => $this->settings['OAUTH2_CLIENT_ID'],
      'redirect_uri' => 'http://localhost:8000/login/discord',
      'response_type' => 'code',
      'scope' => 'identify email'
    );
    return 'https://discordapp.com/api/oauth2/authorize' . '?' . http_build_query($params);
  }
  
  public function getDiscordUser($code) {
    $headers = [
      'grant_type' => 'authorization_code',
      'client_id' => $this->settings['OAUTH2_CLIENT_ID'],
      'client_secret' => $this->settings['OAUTH2_CLIENT_SECRET'],
      'redirect_uri' => 'http://localhost:8000/login/discord',
      'code' => $code,
      'scope' => 'identify email'
    ];
    $response = $this->guzzle->request('POST', 'https://discord.com/api/oauth2/token', ['form_params' => $headers]);
    $response = json_decode((string) $response->getBody());
    $user = $this->guzzle->request('GET','https://discord.com/api/users/@me', [
      'headers' => [
        'Authorization' => "Bearer $response->access_token",
      ]
    ]);
    return json_decode((string) $user->getBody());
  }
}