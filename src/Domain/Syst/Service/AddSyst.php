<?php

namespace App\Domain\Syst\Service;

use App\Service\Service;
use App\Domain\Syst\Repository\Syst as Repo;
use App\Domain\Syst\Data\Syst as SystData;

final class AddSyst extends Service
{

  protected $repo;

  private $filters = [
    'name' => [
      'filter' => FILTER_SANITIZE_SPECIAL_CHARS,
      'flags' => FILTER_FLAG_ENCODE_HIGH,
    ],
    'distance' => [
      'filter' => FILTER_VALIDATE_FLOAT,
      'min_range' => '.25',
      'max_range' => '10'
    ],
    'speed' => [
      'filter' => FILTER_VALIDATE_FLOAT,
      'min_range' => '.01',
    ],
    'star' => [
      'filter' => FILTER_VALIDATE_INT
    ]
  ];

  public function __construct(Repo $repo)
  {
    $this->repo = $repo;
    parent::__construct();
  }

  public function addSyst($data)
  {
    $this->data = $data;
    if (!$this->validate()) {
      $this->payload->returnError();
      return $this->payload;
    }
    if (!$this->data->id = (int) $this->repo->insert($this->data)) {
      $this->payload->returnError();
      $this->payload->errorMessage($this->repo->getMessage());
      return $this->payload;
    }
    $this->data->govt = null;
    $syst = new SystData($this->data);
    $this->payload->SuccessMessage($syst->name . " has been created!");
    $this->payload->addData('syst', $syst);
    return $this->payload;
  }

  public function validate()
  {
    $this->data =  (object) filter_var_array($this->data, $this->filters);
    $valid = true;
    if ('' === $this->data->name) {
      $this->error->addMessage("Name can not be empty");
      $valid = false;
    }
    if (false === $this->data->distance) {
      $this->error->addMessage("Distance can not be empty");
      $valid = false;
    }
    if (false === $this->data->speed) {
      $this->error->addMessage("Speed can not be empty");
      $valid = false;
    }
    return $valid;
  }
}
