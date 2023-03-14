<?php

declare(strict_types=1);

namespace GildedRose\Item;

class Sulfuras extends AbstractItem implements ItemInterface
{
    public function getNewQuality(): int
    {
        return $this->item->quality;
    }

    public function updateSellin(): void
    {
    }

    protected function getHighestQuality(): int
    {
        return 80;
    }
}
