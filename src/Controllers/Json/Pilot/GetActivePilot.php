<?php 

namespace ssim\Controllers\Json\Pilot;

use Psr\Http\Message\ResponseInterface as Response;
use ssim\Controllers\Json\Pilot\PilotContoller;

class GetActivePilot extends PilotController {

  public function action(): Response {
    if(!$pilot = $this->pilot->getActivePilot()) {
     return $this->respond(["Not authorized"], 403);
    }
    return $this->respond($pilot);
  }

}