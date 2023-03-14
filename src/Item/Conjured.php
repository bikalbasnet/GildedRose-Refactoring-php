<?php

declare(strict_types=1);

namespace GildedRose\Item;

class Conjured extends AbstractItem implements ItemInterface
{
    protected function getNewQuality(): int
    {
        if ($this->item->quality <= 0) {
            return $this->item->quality;
        }

        return $this->item->quality - 2;
    }
}
