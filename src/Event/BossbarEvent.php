<?php

declare(strict_types=1);

namespace Event;

use pocketmine\network\mcpe\protocol\BossEventPacket;
use pocketmine\Player;
/**
 * BossbarEvent
 */
class BossbarEvent
{
  
  public function __construct( int $eventType = 0, float $health = 1, string $title = "")
  {
    $this->title = $title;
    $this->health = $health;
    $this->eventType = $eventType;
    
    $this->pk = new BossEventPacket();
    
    $this->pk->eventType = $eventType;
    $this->pk->healthPercent = $health;
    $this->pk->title = $title;
    $this->pk->color = 1;
    $this->pk->overlay = 1;
  }
  
  public function sendBar(Player $player) 
  {
    $this->pk->bossEid = $player->getId();
    $this->pk->playerEid = $player->getId();
    $player->dataPacket($this->pk);
  }
  
  
  public function getScore(): float{
    return $this->pk->healthPercent;
  }
  
  public function getTitle(): string{
    return $this->pk->title;
  }
  
  public function getType(): int{
    return $this->pk->eventType;
  }
  
  public function setScore($score){
    if($score > 1 or $score < 0) {
      $score = 1;
    }
    $this->pk->healthPercent = $score;
  }
  
  public function setTitle($title){
    $this->pk->title = $title;
  }
  
  public function setType($type){
    $this->pk->eventType = $type;
  }
}

?>
