<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    /**
     * @param Item[] $items
     */
    public function __construct(
        private array $items
    ) {
    }

    public function updateInventory(): void
    {
        foreach ($this->items as $item) {
            $inventoryItem = InventoryItemFactory::create($item);
            $inventoryItem->updateInventory();
        }
    }
}
