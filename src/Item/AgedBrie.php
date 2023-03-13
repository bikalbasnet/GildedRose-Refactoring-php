<?php

declare(strict_types=1);

namespace GildedRose\Item;

class AgedBrie extends StandardItem implements ItemInterface
{
    public function updateItemQuality(): void
    {
        if ($this->quality >= 50) {
            return;
        }

        $increment = ($this->sellIn <= 0) ? 2 : 1;

        $newQuality = $this->quality + $increment;
        $this->quality = min($newQuality, 50);
    }
}
