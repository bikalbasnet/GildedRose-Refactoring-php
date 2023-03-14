<?php

declare(strict_types=1);

namespace GildedRose\Item;

class BackstagePasses extends AbstractItem implements ItemInterface
{
    protected function getNewQuality(): int
    {
        if ($this->item->sellIn <= 0) {
            return 0;
        }

        $increment = match (true) {
            $this->item->sellIn <= 5 => 3,
            $this->item->sellIn <= 10 => 2,
            default => 1,
        };

        return $this->item->quality + $increment;
    }
}
