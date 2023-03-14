<?php

declare(strict_types=1);

namespace GildedRose\Item;

class AgedBrie extends AbstractItem implements ItemInterface
{
    protected function getNewQuality(): int
    {
        $increment = ($this->item->sellIn <= 0) ? 2 : 1;

        return $this->item->quality + $increment;
    }
}
