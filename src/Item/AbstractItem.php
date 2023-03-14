<?php

declare(strict_types=1);

namespace GildedRose\Item;

use GildedRose\Item;

abstract class AbstractItem implements ItemInterface
{
    public function __construct(
        protected Item $item,
    ) {
    }

    public function updateInventory(): void
    {
        $quality = $this->getNewQuality();
        $this->item->quality = min($quality, $this->getHighestQuality());
        $this->updateSellin();
    }

    protected function getHighestQuality(): int
    {
        return 50;
    }

    abstract protected function getNewQuality(): int;

    protected function updateSellin(): void
    {
        $this->item->sellIn = $this->item->sellIn - 1;
    }
}
