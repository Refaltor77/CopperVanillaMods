<?php

namespace refaltor\coppervanillamods\listeners;

use pocketmine\Server;
use refaltor\coppervanillamods\Main;
use refaltor\coppervanillamods\utils\Utils;

class ListenerManager
{
    public function init()
    {
        Utils::callDirectory("listeners" . DIRECTORY_SEPARATOR . "lists", function (string $namespace): void{
            Server::getInstance()->getPluginManager()->registerEvents(new $namespace(), Main::getInstance());
        });
    }
}