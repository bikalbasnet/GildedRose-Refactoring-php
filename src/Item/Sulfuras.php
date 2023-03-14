<?php

declare(strict_types=1);

namespace GildedRose\Item;

class Sulfuras extends AbstractItem implements ItemInterface
{
    public function updateSellin(): void
    {
    }

    protected function getNewQuality(): int
    {
        return $this->item->quality;
    }

    protected function getHighestQuality(): int
    {
        return 80;
    }
}
