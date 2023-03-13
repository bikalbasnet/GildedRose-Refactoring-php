<?php

declare(strict_types=1);

namespace GildedRose\Item;

class BackstagePasses extends StandardItem implements ItemInterface
{
    public function updateItemQuality(): void
    {
        if ($this->sellIn <= 0) {
            $this->quality = 0;
            return;
        }

        if ($this->quality >= 50) {
            return;
        }

        $increment = 1;

        if ($this->sellIn <= 10) {
            $increment = 2;
        }

        if ($this->sellIn <= 5) {
            $increment = 3;
        }

        $newQuality = $this->quality + $increment;
        $this->quality = min($newQuality, 50);
    }
}
