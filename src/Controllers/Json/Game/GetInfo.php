<?php 

namespace ssim\Controllers\Json\Game;

use Psr\Http\Message\ResponseInterface as Response;
use ssim\Controllers\Json\Game\GameController;

class GetInfo extends GameController {

  public function action(): Response {
    return $this->respondWithData($this->game->info());
  }

}