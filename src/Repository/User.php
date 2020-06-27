<?php 

namespace ssim\Repository;

use ParagonIE\EasyDB\EasyDB as DB;

use ssim\Model\User as UserModel;

class User {

  private $db;

  private $fields = [
    'email',
    'password',
    'activation_key',
    'status'
  ];

  public $currentUser = [];

  public function __construct(DB $db) {
    $this->db = $db;
    if($_SESSION[SSIM_IDENT] && isset($_SESSION[SSIM_IDENT]['user'])){
      $this->currentUser = new UserModel($this->getCurrentUser());
    }
  }

  public function login($email, $password) {
    $user = $this->getUserByEmail($email);
    if(!$user) return false;
    if($user->activation_key) return false;
    if(\password_verify($password, $user->password)) {
      $_SESSION[SSIM_IDENT]['user'] = $user->id;
      $_SESSION[SSIM_IDENT]['email'] = $user->email;
      return new UserModel($user);
    }
    
    return false;
  }

  public function addNew($email, $password) {
    if($this->doesUserExist($email)) {
      return false;
    }

    $activationToken = $this->generateActivationKey();

    if(SSIM_DEBUG) var_dump($activationToken);

    $id = $this->db->insertReturnId('ssim_users',[
      'email'    => $email,
      'password' => password_hash($password, PASSWORD_DEFAULT),
      'created_ip' => ip2long($_SERVER['REMOTE_ADDR']),
      'activation_key' => password_hash($activationToken, PASSWORD_DEFAULT)
    ]);

    if($this->isFirstUser()) {
      $this->activateUser($id);
    }

  }

  private function updateUser(int $id, string $key, $value) {
    if(!in_array($key, $this->fields)) return false;
    return $this->db->update('ssim_users',[
      $key => $value
    ], [
      'id' => $id
    ]);
  }

  private function getUserByEmail($email) {
    return $this->db->row("SELECT u.id, u.email, u.password, u.created, u.activation_key FROM ssim_users u WHERE u.email = ?", $email);
  }

  private function getCurrentUser(){
    return $this->db->row("SELECT u.id, u.email FROM ssim_users u WHERE u.id = ? AND u.activation_key IS NULL", $_SESSION[SSIM_IDENT]['user']);
  }

  private function doesUserExist($email) {
    if(!$this->db->cell("SELECT email FROM ssim_users WHERE email = ?", $email))return false;

    return true;
  }

  private function isFirstUser() {
    return (bool) $this->db->cell("SELECT count(id) as count FROM ssim_users");
  }

  private function activateUser($id) {
    return $this->updateUser($id, 'activation_key', null);
  }

  private function generateActivationKey(){
    return bin2hex(openssl_random_pseudo_bytes(16));
  }

}