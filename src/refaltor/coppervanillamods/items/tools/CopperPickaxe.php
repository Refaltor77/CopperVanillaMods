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
use pocketmine\block\Block;
use pocketmine\block\BlockToolType;
use pocketmine\inventory\ArmorInventory;
use pocketmine\item\Armor;
use pocketmine\item\ArmorTypeInfo;
use pocketmine\item\enchantment\VanillaEnchantments;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\Pickaxe;
use pocketmine\item\Sword;
use pocketmine\item\ToolTier;
use pocketmine\item\VanillaItems;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use refaltor\coppervanillamods\utils\Utils;

class CopperPickaxe extends Pickaxe implements ItemComponents {
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier)
    {
        $name = 'item.copper:pickaxe';

        $info = ToolTier::NETHERITE();

        $inventory = new CreativeInventoryInfo(
            CreativeInventoryInfo::CATEGORY_EQUIPMENT,
            CreativeInventoryInfo::GROUP_PICKAXE,
        );

        parent::__construct($identifier, $name, $info);

        $this->initComponent('copper_pickaxe',$inventory);

        $this->addComponent(new DurabilityComponent($this->getMaxDurability()));
        $this->addComponent(new MaxStackSizeComponent(1));
        $this->addComponent(new HandEquippedComponent(true));
        $component = Utils::getDiggerComponent($this, $this->getMiningEfficiency(true));
        if (!is_null($component)) $this->addComponent($component);
    }

    public function onDestroyBlock(Block $block, array &$returnedItems): bool
    {
        return parent::onDestroyBlock($block, $returnedItems);
    }


    public function getAttackPoints(): int
    {
        return 3;
    }

    protected function getBaseMiningEfficiency(): float
    {
        return 5;
    }

    public function getBlockToolType(): int
    {
        return BlockToolType::PICKAXE;
    }

    public function getMaxDurability(): int
    {
        return 175;
    }
}