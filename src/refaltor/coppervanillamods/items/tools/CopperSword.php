<?php

namespace refaltor\coppervanillamods\items\tools;

use customiesdevs\customies\item\component\ArmorComponent;
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
use pocketmine\item\ItemIdentifier;
use pocketmine\item\Sword;
use pocketmine\item\ToolTier;
use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat;
use refaltor\coppervanillamods\utils\Utils;

class CopperSword extends Sword implements ItemComponents {
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier)
    {
        $name = 'item.copper:sword';

        $info = ToolTier::NETHERITE();

        $inventory = new CreativeInventoryInfo(
            CreativeInventoryInfo::CATEGORY_EQUIPMENT,
            CreativeInventoryInfo::GROUP_SWORD,
        );

        parent::__construct($identifier, $name, $info);

        $this->initComponent('copper_sword',$inventory);

        $this->addComponent(new DurabilityComponent($this->getMaxDurability()));
        $this->addComponent(new MaxStackSizeComponent(1));
        $this->addComponent(new HandEquippedComponent(true));
    }

    public function getAttackPoints(): int
    {
        return 5;
    }

    public function getBlockToolType(): int
    {
        return BlockToolType::SWORD;
    }

    public function getMiningEfficiency(bool $isCorrectTool): float
    {
        return 1.0;
    }

    public function getMaxDurability(): int
    {
        return 175;
    }
}