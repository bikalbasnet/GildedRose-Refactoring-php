<?php

declare(strict_types=1);

namespace GildedRose\Item;

class BackstagePasses implements ItemInterface
{
    public function __construct(
        private int $sellIn,
        private int $quality,
    ) {
    }
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
