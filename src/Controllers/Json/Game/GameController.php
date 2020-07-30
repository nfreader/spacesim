<?php 

namespace ssim\Controllers\Json\Game;

use ssim\Controllers\Json\JsonController;
use ssim\Repository\Game;

abstract class GameController extends JsonController {

  protected $game;

  public function __construct(Game $game) {
    $this->game = $game;
  }

}