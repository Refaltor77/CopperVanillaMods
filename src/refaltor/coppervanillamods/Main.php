<?php

namespace refaltor\coppervanillamods;

use customiesdevs\customies\item\CustomiesItemFactory;
use pocketmine\plugin\PluginBase;
use refaltor\coppervanillamods\items\armor\CopperBoots;
use refaltor\coppervanillamods\items\armor\CopperChestplate;
use refaltor\coppervanillamods\items\armor\CopperHelmet;
use refaltor\coppervanillamods\items\armor\CopperLeggings;
use refaltor\coppervanillamods\items\tools\CopperAxe;
use refaltor\coppervanillamods\items\tools\CopperHoe;
use refaltor\coppervanillamods\items\tools\CopperPickaxe;
use refaltor\coppervanillamods\items\tools\CopperShovel;
use refaltor\coppervanillamods\items\tools\CopperSword;
use refaltor\coppervanillamods\libs\Packs;
use refaltor\coppervanillamods\listeners\ListenerManager;
use refaltor\coppervanillamods\recipes\RecipesManager;

class Main extends PluginBase
{
    private static ?self $instance = null;
    public string $file;

    protected function onLoad(): void
    {
        self::$instance = $this;
        $this->file = $this->getFile();

        $pack = Packs::generatePackFromResources($this, "pack_copper");
        Packs::unregisterResourcePack($pack);
        Packs::registerResourcePack($pack);
    }

    protected function onEnable(): void
    {
        CustomiesItemFactory::getInstance()->registerItem(CopperHelmet::class, IdsCustom::COPPER_HELMET, "Copper Helmet");
        CustomiesItemFactory::getInstance()->registerItem(CopperChestplate::class, IdsCustom::COPPER_CHESTPLATE, "Copper Chestplate");
        CustomiesItemFactory::getInstance()->registerItem(CopperLeggings::class, IdsCustom::COPPER_LEGGINGS, "Copper Leggings");
        CustomiesItemFactory::getInstance()->registerItem(CopperBoots::class, IdsCustom::COPPER_BOOTS, "Copper Boots");

        CustomiesItemFactory::getInstance()->registerItem(CopperAxe::class, IdsCustom::COPPER_AXE, "Copper Axe");
        CustomiesItemFactory::getInstance()->registerItem(CopperHoe::class, IdsCustom::COPPER_HOE, "Copper Hoe");
        CustomiesItemFactory::getInstance()->registerItem(CopperPickaxe::class, IdsCustom::COPPER_PICKAXE, "Copper Pickaxe");
        CustomiesItemFactory::getInstance()->registerItem(CopperShovel::class, IdsCustom::COPPER_SHOVEL, "Copper Shovel");
        CustomiesItemFactory::getInstance()->registerItem(CopperSword::class, IdsCustom::COPPER_SWORD, "Copper Sword");


        (new ListenerManager())->init();
        (new RecipesManager())->init();
    }


    public static function getInstance(): self {return self::$instance;}
}