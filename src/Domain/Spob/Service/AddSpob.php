<?php

namespace App\Domain\Spob\Service;

use App\Service\Service;
use App\Domain\Spob\Repository\Spob as Repo;
use App\Domain\Spob\Data\SpobTypes as Types;

class AddSpob extends Service
{

  private $repo;
  private $types;

  private $filters = [
    'name' => [
      'filter' => FILTER_SANITIZE_SPECIAL_CHARS,
      'flags' => FILTER_FLAG_ENCODE_HIGH,
    ],
    'type' => [
      'filter' => FILTER_SANITIZE_STRING,
      'flags' => FILTER_FLAG_STRIP_LOW,
    ],
    'techlevel' => [
      'filter' => FILTER_VALIDATE_INT,
      'options' => [
        'min_range' => 1,
        'max_range' => 10,
        'default' => 1
      ]
    ],
    'syst' => [
      'filter' => FILTER_VALIDATE_INT,
      'options' => [
        'min_range' => 1,
      ]
    ],
    'star' => [
      'filter' => FILTER_VALIDATE_INT,
      'options' => [
        'min_range' => 1,
      ]
    ],
    'desc' => [
      'filter' => FILTER_SANITIZE_SPECIAL_CHARS,
      'flags' => FILTER_FLAG_ENCODE_HIGH
    ],
    'homeworld' => [
      'filter' => FILTER_VALIDATE_BOOLEAN
    ]
  ];

  public function __construct(Repo $repo, Types $types)
  {
    $this->repo = $repo;
    $this->types = $types;
    $this->types = $this->types->getTypes();
    parent::__construct();
  }

  public function addSpob($data)
  {
    $this->data = $data;
    if (!$this->validate()) {
      $this->payload->returnError();
      return $this->payload;
    }
    $this->data->type = (object) $this->types[$this->data->type];
    var_dump($this->data);
    if (!$id = $this->repo->insert($this->data)) {
      $this->payload->returnError();
      $this->payload->errorMessage($this->repo->getMessage());
      return $this->payload;
    }
    $this->data->id = $id;
    $this->payload->addData('spob', $this->data);
    return $this->payload;
  }

  private function validate()
  {
    $this->data = (object) filter_var_array($this->data, $this->filters);
    $valid = true;

    return $valid;
  }
}
