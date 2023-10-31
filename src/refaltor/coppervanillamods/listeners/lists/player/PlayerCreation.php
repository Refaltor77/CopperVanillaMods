<?php

namespace refaltor\coppervanillamods\listeners\lists\player;

use pocketmine\event\Listener;
use refaltor\coppervanillamods\player\CustomPlayer;

class PlayerCreation implements Listener
{
    public function onPlayerCreation(\pocketmine\event\player\PlayerCreationEvent $event): void {
        $event->setPlayerClass(CustomPlayer::class);
    }
}