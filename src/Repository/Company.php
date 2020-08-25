<?php

namespace ssim\Repository;

use Paragonie\EasyDB\EasyDB as DB;

use ssim\Repository\Audit;
use ssim\Notification\Flash;

use ssim\Model\Company as CompanyModel;

class Company {

  protected $db;
  protected $audit;
  protected $flash;

  private $filters = [
    'name' => [
      'filter' => FILTER_SANITIZE_STRING,
      'flags' => FILTER_FLAG_STRIP_HIGH
    ],
  ];

  public function __construct(DB $db, Audit $audit, Flash $flash){
    $this->db = $db;
    $this->audit = $audit;
    $this->flash = $flash;
  }

  public function addNew($data) {
    if($this->getUserCompany()->id){
      $this->flash->Error("You have already created a company");
      return false;
    }
    $this->data = $data;
    if(!$this->validateData()){
      return false; 
    }
    try {
      $this->db->insert('ssim_companies',$this->data);
    } catch (\PDOException $e){
      if(SSIM_DEBUG) {
        $this->flash->Error($e->getMessage().". This company was not created.");
      } else {
        $this->flash->Error("This company could not be created");
      }
      return false;
    }
    $this->flash->Success("Your company, ".$this->data['name']." was successfully created!");
    $this->audit->addNew('NEWCOMPANY', "Created ".$this->data['name']);

  }

  public function validateData(){
    $this->data = filter_var_array($this->data, $this->filters);
    $valid = true;
    $this->data['name'] = \preg_replace("/([^A-Za-z0-9.\- ])/",'',$this->data['name']);
    if ('' === $this->data['name']) {
      $this->flash->Error("Company name is invalid!");
      $valid = false;
    }
    $this->data['user'] = $_SESSION[SSIM_IDENT]['user'];
    return $valid;
  }

  public function getUserCompany($user){
    return new CompanyModel($this->db->row("SELECT c.id, c.name, c.homeworld FROM ssim_companies c WHERE c.user = ?", $user));
  }

}