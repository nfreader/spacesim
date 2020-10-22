<?php

namespace App\Domain\Star\Service;

use App\Service\Service;
use App\Domain\Star\Repository\Star as Repo;
use App\Domain\Star\Data\Types;
use App\Data\Payload\ActionPayload as Payload;
use App\Data\Payload\ActionErrorPayload as Error;

final class AddStar extends Service
{

  protected $repo;
  protected $types;

  public function __construct(Repo $repo, Types $types, Payload $payload, Error $error)
  {
    $this->repo = $repo;
    $this->types = $types;
    $this->types = $this->types->getTypes();
    parent::__construct($payload, $error);
  }

  public function addStar($data)
  {
    $this->data = (object) $data;
    if (!$this->validate()) {
      return $this->error;
    }
    if (!$this->data->id = $this->repo->insert($this->data)) {
      return $this->error;
    }
    $this->payload->SuccessMessage($this->data->name . " has been created!");
    $this->payload->addData('star', $this->data);
    return $this->payload;
    var_dump($this->data);
  }

  private function validate()
  {
    $valid = true;
    $this->data->name = filter_var($this->data->name, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
    if (!$this->data->name) $valid = false;
    $this->data->x = filter_var($this->data->x, FILTER_VALIDATE_INT);
    $this->data->y = filter_var($this->data->y, FILTER_VALIDATE_INT);
    if (in_array($this->data->type, array_keys($this->types))) {
      $this->data->type = $this->types[$this->data->type];
    } else {
      $valid = false;
    }
    return $valid;
  }
}
