<?php

declare(strict_types=1);

namespace GildedRose\Item;

class StandardItem extends AbstractItem implements ItemInterface
{
    protected function getNewQuality(): int
    {
        if ($this->item->quality <= 0) {
            return $this->item->quality;
        }

        $decrement = ($this->item->sellIn <= 0) ? 2 : 1;

        return $this->item->quality - $decrement;
    }
}
