<?php

declare(strict_types=1);

namespace GildedRose\Item;

class BackstagePasses extends AbstractItem implements ItemInterface
{
    public function getNewQuality(): int
    {
        if ($this->item->sellIn <= 0) {
            $this->item->quality = 0;
            return $this->item->quality;
        }

        $increment = match(true) {
            $this->item->sellIn <=5 => 3,
            $this->item->sellIn <= 10 => 2,
            default => 1,
        };

        return $this->item->quality + $increment;
    }
}
