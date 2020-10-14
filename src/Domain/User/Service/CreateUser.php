<?php

namespace App\Domain\User\Service;

use App\Service\Service;
use App\Domain\User\Repository\AddUser as Repo;

final class CreateUser extends Service {

  private $repo;

  public function __construct(Repo $repo){
    $this->repo = $repo;
    parent::__construct();
  }

  public function CreateUser(array $data){
    $this->data = $data;
    if(!$this->validateData()){
      return $this->error;
    }
    $data = $this->repo->AddAccount($this->data);
    $this->payload->setData($data);
    $this->payload->SuccessMessage("Your account has been created, but will need to be activated before you can log in. Please see your email for instructions.");
    return $this->payload;
  }

  private function validateData() {
    $valid = true;

    $this->data['password'] = rtrim(trim($this->data['password']));

    if(!filter_var($this->data['email'], FILTER_VALIDATE_EMAIL)){
      $this->error->addMessage("The provided email address is invalid");
      $valid = false;
    }

    if($this->data['password'] !== $this->data['password_confirm']){
      $this->error->addMessage("Your passwords do not match");
      $valid = false;
    }
    
    if(!$this->data['password']) {
      $this->error->addMessage("You must enter a password");
      $valid = false;
    }
    
    return $valid;
  }

}