<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    /**
     * @param Item[] $items
     */
    public function __construct(
        private array $items
    ) {
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            $this->updateItem($item);
        }
    }

    public function updateItem(Item $item): void
    {
        if ($item->name === 'Sulfuras, Hand of Ragnaros') {
            return;
        }

        $this->incrementItemQuality($item);
        $this->decrementItemQuality($item);

        $this->updateBackStageQuality($item);
        $this->updateSellin($item);

        if ($item->sellIn >= 0)
        {
            return;
        }

        $this->incrementItemQuality($item);
        $this->decrementItemQuality($item);
    }

    /**
     * @param Item $item
     * @return void
     */
    public function updateBackStageQuality(Item $item): void
    {
        if ($item->name !== 'Backstage passes to a TAFKAL80ETC concert')
        {
            return;
        }

        if ($item->sellIn <= 10) {
            $this->incrementItemQuality($item);
        }
        if ($item->sellIn <= 5) {
            $this->incrementItemQuality($item);
        }
    }

    /**
     * @param Item $item
     * @return void
     */
    public function updateSellin(Item $item): void
    {
        $item->sellIn = $item->sellIn - 1;
    }

    /**
     * @param Item $item
     * @return void
     */
    public function incrementItemQuality(Item $item): void
    {
        if ($item->name !== 'Aged Brie' && $item->name !== 'Backstage passes to a TAFKAL80ETC concert')
        {
            return;
        }

        if ($item->quality < 50) {
            $item->quality = $item->quality + 1;
        }
    }

    /**
     * @param Item $item
     * @return void
     */
    public function decrementItemQuality(Item $item): void
    {
        if ($item->sellIn <= 0 && $item->name === 'Backstage passes to a TAFKAL80ETC concert')
        {
            $item->quality = 0;
        }

        if ($item->name === "Aged Brie" || $item->name === 'Backstage passes to a TAFKAL80ETC concert')
        {
            return;
        }

        if ($item->quality > 0) {
            $item->quality = $item->quality - 1;
        }
    }
}
