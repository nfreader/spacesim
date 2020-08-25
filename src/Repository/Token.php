<?php

declare(strict_types=1);

namespace ssim\Repository;

use ssim\Repository\SecretKey;

use ParagonIE\Paseto\Builder;
use ParagonIE\Paseto\Purpose;
use ParagonIE\Paseto\Protocol\Version2;
use ParagonIE\Paseto\Keys\{
  AsymmetricSecretKey,
  SymmetricKey    
};
use ParagonIE\Paseto\Exception\PasetoException;
use ParagonIE\Paseto\Parser;
use ParagonIE\Paseto\Rules\{
    IssuedBy,
    NotExpired
};
use ParagonIE\Paseto\ProtocolCollection;

class Token {

  protected $secretKey;

  private $sharedKey;

  public function __construct(SecretKey $secretKey) {
    $this->secretKey = $secretKey;
    $privateKey = new AsymmetricSecretKey(sodium_crypto_sign_keypair());
    $publicKey = $privateKey->getPublicKey();
    $this->sharedKey = new SymmetricKey($this->secretKey->key);
  }

  public function generateToken(array $payload) {
    // $token = Builder::getLocal($this->sharedKey, new Version2());
    $token = (new Builder())
    ->setKey($this->sharedKey)
    ->setVersion(new Version2())
    ->setPurpose(Purpose::local())
    // Set it to expire in one day
    ->setExpiration(
        (new \DateTime())->add(new \DateInterval('P01D'))
    )
    // Store arbitrary data
    ->setClaims($payload);
    return $token->toString();
  }

  public function decryptToken($providedToken){
    $parser = (new Parser())
    ->setKey($this->sharedKey)
    // Adding rules to be checked against the token
    ->addRule(new NotExpired)
    // ->addRule(new IssuedBy('issuer defined during creation'))
    ->setPurpose(Purpose::local())
    // Only allow version 2
    ->setAllowedVersions(ProtocolCollection::v2());

    try {
        $token = $parser->parse($providedToken);
    } catch (PasetoException $ex) {
      var_dump($ex->getMessage());
    }
    var_dump($token instanceof \ParagonIE\Paseto\JsonToken);
    var_dump($token);
  }

}