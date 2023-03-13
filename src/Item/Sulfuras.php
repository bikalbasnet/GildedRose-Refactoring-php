<?php

declare(strict_types=1);

namespace GildedRose\Item;

class Sulfuras implements ItemInterface
{
    public function __construct(
        private int $sellIn,
        private int $quality,
    ) {
    }

    public function updateItemQuality(): void
    {
    }

    public function updateSellin(): void
    {
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
{

}
