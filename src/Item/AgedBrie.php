<?php

declare(strict_types=1);

namespace GildedRose\Item;

class AgedBrie implements ItemInterface
{
    public function __construct(
        private int $sellIn,
        private int $quality,
    ) {
    }

    public function updateItemQuality(): void
    {
        if ($this->quality >= 50) {
            return;
        }

        $increment = ($this->sellIn <= 0) ? 2 : 1;

        $newQuality = $this->quality + $increment;
        $this->quality = min($newQuality, 50);
    }

    public function updateSellin(): void
    {
        $this->sellIn = $this->sellIn - 1;
    }

    public function getQuality(): int
    {
        return $this->quality;
    }

    public function getSellIn(): int
    {
        return $this->sellIn;
    }
}
