<?php

namespace ssim\Repository;

use Paragonie\EasyDB\EasyDB as DB;

use ssim\Repository\Audit;
use ssim\Notification\Flash;
use ssim\Repository\User;

use ssim\Model\Pilot as PilotModel;

class Pilot {

  protected $db;
  protected $audit;
  protected $flash;
  protected $user;

  private $filters = [
    'name' => [
      'filter' => FILTER_SANITIZE_STRING,
      'flags' => FILTER_FLAG_STRIP_HIGH
    ],
  ];

  public function __construct(DB $db, Audit $audit, Flash $flash, User $user){
    $this->db = $db;
    $this->audit = $audit;
    $this->flash = $flash;
    $this->user = $user;
  }

  public function getUserPilots(){
    return $this->getPilotsForUser($this->user->currentUser->getId());
  }

  public function getPilotsForUser(int $user) {
    $pilots = $this->db->run("SELECT
    p.id,
    p.name,
    p.credits,
    p.legal,
    p.star,
    p.syst,
    p.spob,
    p.fingerprint
    FROM ssim_pilots p
    WHERE p.user = ?", $user);
    foreach ($pilots as &$pilot){
      $pilot = new PilotModel($pilot);
    }
    return $pilots;
  }

  public function addNew($data) {
    $this->data = $data;
    if(!$this->validateData()){
      return false; 
    }
    try {
      $this->db->insert('ssim_pilots',$this->data);
    } catch (\PDOException $e){
      if(SSIM_DEBUG) {
        $this->flash->Error($e->getMessage().". This pilot was not created.");
      } else {
        $this->flash->Error("This pilot could not be registered");
      }
      return false;
    }
    $this->flash->Success("Your pilot, ".$this->data['name']." was successfully registered!");
    $this->audit->addNew('NEWPILOT', "Created ".$this->data['name']);

  }

  public function validateData(){
    $this->data = filter_var_array($this->data, $this->filters);
    if(3 === $this->db->cell("SELECT count(id) FROM ssim_pilots WHERE user = ?",$this->user->currentUser->getId())) {
      $this->flash->Error("You cannot register any more pilots");
      return false;
    }
    $this->data['name'] = \preg_replace("/([^A-Za-z0-9.\- ])/",'',$this->data['name']);
    if ('' === $this->data['name']) {
      $this->flash->Error("Pilot name is invalid!");
      return false;
    }
    $this->data['user'] = $this->user->currentUser->getId();
    $this->data['company'] = $this->user->currentUser->company->id;
    $this->data['legal'] = SSIM_STARTING_LEGAL;
    $this->data['credits'] = SSIM_STARTING_CREDITS;
    return true;
  }

}