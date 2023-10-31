<?php

namespace refaltor\coppervanillamods\items\tools;

use customiesdevs\customies\item\component\ArmorComponent;
use customiesdevs\customies\item\component\DiggerComponent;
use customiesdevs\customies\item\component\DurabilityComponent;
use customiesdevs\customies\item\component\HandEquippedComponent;
use customiesdevs\customies\item\component\MaxStackSizeComponent;
use customiesdevs\customies\item\component\WearableComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\block\BlockToolType;
use pocketmine\inventory\ArmorInventory;
use pocketmine\item\Armor;
use pocketmine\item\ArmorTypeInfo;
use pocketmine\item\Axe;
use pocketmine\item\enchantment\VanillaEnchantments;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\Pickaxe;
use pocketmine\item\Shovel;
use pocketmine\item\Sword;
use pocketmine\item\ToolTier;
use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat;
use refaltor\coppervanillamods\utils\Utils;

class CopperShovel extends Shovel implements ItemComponents {
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier)
    {
        $name = 'item.copper:shovel';

        $info = ToolTier::NETHERITE();

        $inventory = new CreativeInventoryInfo(
            CreativeInventoryInfo::CATEGORY_EQUIPMENT,
            CreativeInventoryInfo::GROUP_SHOVEL,
        );

        parent::__construct($identifier, $name, $info);

        $this->initComponent('copper_shovel',$inventory);

        $this->addComponent(new DurabilityComponent($this->getMaxDurability()));
        $this->addComponent(new MaxStackSizeComponent(1));
        $this->addComponent(new HandEquippedComponent(true));
        $component = Utils::getDiggerComponent($this, $this->getMiningEfficiency(true));
        if (!is_null($component)) $this->addComponent($component);
    }

    public function getAttackPoints(): int
    {
        return 2;
    }

    public function getBlockToolType(): int
    {
        return BlockToolType::SHOVEL;
    }

    protected function getBaseMiningEfficiency(): float
    {
        return 5;
    }

    public function getMaxDurability(): int
    {
        return 175;
    }
}