<?php

namespace refaltor\coppervanillamods\recipes;

use customiesdevs\customies\item\CustomiesItemFactory;
use pocketmine\block\VanillaBlocks;
use pocketmine\crafting\ExactRecipeIngredient;
use pocketmine\crafting\ShapedRecipe;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\Server;
use refaltor\coppervanillamods\IdsCustom;

final class RecipesManager
{
    public function init(): void {
        $copperIngot = VanillaItems::COPPER_INGOT();
        $stick = VanillaItems::STICK();
        $air = VanillaItems::AIR();
        $itemFactory = CustomiesItemFactory::getInstance();

        $this->registerAllTools(
            $copperIngot,
            $stick,
            $itemFactory->get(IdsCustom::COPPER_PICKAXE),
            $itemFactory->get(IdsCustom::COPPER_SWORD),
            $itemFactory->get(IdsCustom::COPPER_HOE),
            $itemFactory->get(IdsCustom::COPPER_SHOVEL),
            $itemFactory->get(IdsCustom::COPPER_AXE),
        );

        $this->registerAllArmors(
            $copperIngot,
            $itemFactory->get(IdsCustom::COPPER_HELMET),
            $itemFactory->get(IdsCustom::COPPER_CHESTPLATE),
            $itemFactory->get(IdsCustom::COPPER_LEGGINGS),
            $itemFactory->get(IdsCustom::COPPER_BOOTS),
        );
    }


    public function registerAllArmors(Item $itemIngot, Item $helmet, Item $chestplate, Item $leggings, Item $boots): void {
        $air = VanillaBlocks::AIR()->asItem();


        $this->registerCraft([
            [$itemIngot, $itemIngot, $itemIngot],
            [$itemIngot,  $air, $itemIngot],
            [$air,  $air, $air],
            [$helmet]
        ]);


        $this->registerCraft([
            [$air, $air, $air],
            [$itemIngot,  $itemIngot, $itemIngot],
            [$itemIngot,  $air, $itemIngot],
            [$helmet]
        ]);



        $this->registerCraft([
            [$itemIngot, $air, $itemIngot],
            [$itemIngot,  $itemIngot, $itemIngot],
            [$itemIngot,  $itemIngot, $itemIngot],
            [$chestplate]
        ]);


        $this->registerCraft([
            [$itemIngot, $itemIngot, $itemIngot],
            [$itemIngot,  $air, $itemIngot],
            [$itemIngot,  $air, $itemIngot],
            [$leggings]
        ]);


        $this->registerCraft([
            [$air, $air, $air],
            [$itemIngot,  $air, $itemIngot],
            [$itemIngot,  $air, $itemIngot],
            [$boots]
        ]);


        $this->registerCraft([
            [$itemIngot, $air, $itemIngot],
            [$itemIngot,  $air, $itemIngot],
            [$air,  $air, $air],
            [$boots]
        ]);
    }


    public function registerAllTools(Item $item, Item $stick, Item $pickaxe, Item $sword, Item $hoe, Item $shovel, Item $axe): void {
        $air = VanillaBlocks::AIR()->asItem();

        //PICKAXE
        $this->registerCraft(
            [
                [$item, $item, $item],
                [$air,  $stick, $air],
                [$air,  $stick, $air],
                [$pickaxe]
            ]);

        //HOE
        $this->registerCraft(
            [
                [$air, $item, $item],
                [$air,  $stick, $air],
                [$air,  $stick, $air],
                [$hoe]
            ]);
        $this->registerCraft(
            [
                [$item, $item, $air],
                [$air,  $stick, $air],
                [$air,  $stick, $air],
                [$hoe]
            ]);

        //AXE
        $this->registerCraft(
            [
                [$air, $item, $item],
                [$air, $stick, $item],
                [$air, $stick, $air],
                [$axe]
            ]);
        $this->registerCraft(
            [
                [$item, $item,  $air],
                [$item, $stick,  $air],
                [$air, $stick, $air],
                [$axe]
            ]);

        //SHOVEL
        $this->registerCraft(
            [
                [$air, $item, $air],
                [$air, $stick,  $air],
                [$air, $stick, $air],
                [$shovel]
            ]);

        //SWORD
        $this->registerCraft(
            [
                [$air, $item, $air],
                [$air, $item,  $air],
                [$air, $stick, $air],
                [$sword]
            ]);

    }



    public function registerCraft(array $craft): void
    {
        $shape = ["", "", ""];
        $y = "a";

        $ingredients = [];


        foreach ($craft[0] as $item) {
            if ($item instanceof Item) {
                if ($item->isNull()|| $item->getName() === 'Air') {
                    $shape[0] .= " ";
                } else {
                    $shape[0] .= $y;
                    $count = $item->getCount();
                    if ($count > 1) {
                        $item->setCount(1);
                        $recipe = new ExactRecipeIngredient($item);
                        $recipe->getItem()->setCount($count);
                    } else $recipe = new ExactRecipeIngredient($item);
                    $ingredients[strval($y)] = $recipe;
                    $y++;
                }
            }
        }

        foreach ($craft[1] as $item) {
            if ($item instanceof Item) {
                if ($item->isNull()|| $item->getName() === 'Air') {
                    $shape[1] .= " ";
                } else {
                    $shape[1] .= $y;
                    $count = $item->getCount();
                    if ($count > 1) {
                        $item->setCount(1);
                        $recipe = new ExactRecipeIngredient($item);
                        $recipe->getItem()->setCount($count);
                    } else $recipe = new ExactRecipeIngredient($item);
                    $ingredients[strval($y)] = $recipe;
                    $y++;
                }
            }
        }

        foreach ($craft[2] as $item) {
            if ($item instanceof Item) {
                if ($item->isNull() || $item->getName() === 'Air') {
                    $shape[2] .= " ";
                } else {
                    $shape[2] .= $y;
                    $count = $item->getCount();
                    if ($count > 1) {
                        $item->setCount(1);
                        $recipe = new ExactRecipeIngredient($item);
                        $recipe->getItem()->setCount($count);
                    } else $recipe = new ExactRecipeIngredient($item);
                    $ingredients[strval($y)] = $recipe;
                    $y++;
                }
            }
        }


        $shape = new ShapedRecipe(
            $shape,
            $ingredients,
            [$craft[3][0]]
        );


        Server::getInstance()->getCraftingManager()->registerShapedRecipe($shape);
    }
}