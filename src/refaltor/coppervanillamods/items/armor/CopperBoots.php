<?php

namespace refaltor\coppervanillamods\items\armor;

use customiesdevs\customies\item\component\ArmorComponent;
use customiesdevs\customies\item\component\DurabilityComponent;
use customiesdevs\customies\item\component\WearableComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\inventory\ArmorInventory;
use pocketmine\item\Armor;
use pocketmine\item\ArmorTypeInfo;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat;

class CopperBoots extends Armor implements ItemComponents {
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier)
    {
        $name = 'item.copper:feet';


        $info = new ArmorTypeInfo(
            $this->getDefensePoints(),
            $this->getMaxDurability(),
            ArmorInventory::SLOT_FEET
        );
        $inventory = new CreativeInventoryInfo(
            CreativeInventoryInfo::CATEGORY_EQUIPMENT,
            CreativeInventoryInfo::GROUP_BOOTS,
        );

        parent::__construct($identifier, $name, $info);

        $this->initComponent('copper_feet',$inventory);

        $this->addComponent(new ArmorComponent($this->getDefensePoints(), "diamond"));
        $this->addComponent(new DurabilityComponent($this->getMaxDurability()));
        $this->addComponent(new WearableComponent(WearableComponent::SLOT_ARMOR_FEET,$this->getDefensePoints()));
    }


    public function getDefensePoints(): int
    {
        return 1;
    }

    public function getMaxDurability(): int
    {
        return 130;
    }
}