<?php

declare(strict_types=1);

namespace GildedRose\Item;

class StandardItem extends AbstractItem implements ItemInterface
{
    public function getNewQuality(): int
    {
        if ($this->item->quality <= 0) {
            return $this->item->quality;
        }

        $decrement = ($this->item->sellIn <= 0) ? 2 : 1;

        return $this->item->quality - $decrement;
    }

    public function updateSellin(): void
    {
        $this->item->sellIn = $this->item->sellIn - 1;
    }

    public function getQuality(): int
    {
        return $this->item->quality;
    }

    public function getSellIn(): int
    {
        return $this->item->sellIn;
    }
}
