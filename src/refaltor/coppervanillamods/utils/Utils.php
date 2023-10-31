<?php

namespace refaltor\coppervanillamods\utils;

use customiesdevs\customies\item\component\DiggerComponent;
use pocketmine\block\BlockToolType;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\Durable;
use pocketmine\item\Item;
use pocketmine\item\Sword;
use pocketmine\item\TieredTool;
use refaltor\coppervanillamods\Main;

final class Utils
{
    public static function getDiggerComponent(Durable $item, int $speed): ?DiggerComponent {
        $blocks = VanillaBlocks::getAll();

        $component = new DiggerComponent();
        $found = false;

        foreach ($blocks as $constant => $block) {
            if ($block->getBreakInfo()->getToolType() == $item->getBlockToolType()) {
                $found = true;
                $component->withBlocks($speed, $block);
            }
        }

        return ($found === true ? $component : null);
    }


    public static function callDirectory(string $directory, callable $callable): void
    {
        $main = explode("\\", Main::getInstance()->getDescription()->getMain());
        unset($main[array_key_last($main)]);
        $main = implode("/", $main);
        $directory = rtrim(str_replace(DIRECTORY_SEPARATOR, "/", $directory), "/");
        $dir = Main::getInstance()->file . "src/$main/" . $directory;


        foreach (array_diff(scandir($dir), [".", ".."]) as $file) {
            $path = $dir . "/$file";
            $extension = pathinfo($path)["extension"] ?? null;

            if ($extension === null) {
                self::callDirectory($directory . "/" . $file, $callable);
            } elseif ($extension === "php") {
                $namespaceDirectory = str_replace("/", "\\", $directory);
                $namespaceMain = str_replace("/", "\\", $main);
                $namespace = $namespaceMain . "\\$namespaceDirectory\\" . basename($file, ".php");
                $callable($namespace);
            }
        }
    }
}