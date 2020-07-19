<?php 

namespace ssim\Controllers\Json\Ship;

use Psr\Http\Message\ResponseInterface as Response;
use ssim\Controllers\Json\Ship\ShipController;

class ViewShips extends ShipController {

  public function action(): Response {
    if($id = $this->resolveOptionalArg('id')){
      return $this->respond($this->ship->getShip((int) $id));
    }
    $ships = $this->ship->getShipyard();
    return $this->respond($ships);
  }

}