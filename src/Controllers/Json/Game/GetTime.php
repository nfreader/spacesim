<?php 

namespace ssim\Controllers\Json\Game;

use Psr\Http\Message\ResponseInterface as Response;
use ssim\Controllers\Json\Game\GameController;

class GetTime extends GameController {

  public function action(): Response {
    return $this->respond(['time' => $this->game->getTime()]);
  }

}