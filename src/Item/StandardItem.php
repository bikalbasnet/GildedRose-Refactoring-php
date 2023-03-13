<?php

declare(strict_types=1);

namespace GildedRose\Item;

class StandardItem implements ItemInterface
{
    public function __construct(
        protected int $sellIn,
        protected int $quality,
    ) {
    }

    public function updateItemQuality(): void
    {
        if ($this->quality <= 0) {
            return;
        }

        $decrement = ($this->sellIn <= 0) ? 2 : 1;

        $newQuality = $this->quality - $decrement;
        $this->quality = max($newQuality, 0);
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
