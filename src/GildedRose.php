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

    public function updateInventory(): void
    {
        foreach ($this->items as $item) {
            if ($item->name === 'Aged Brie') {
                $itemObj = ItemFactory::create($item);
                $itemObj->updateItemQuality();

                $item->sellIn = $itemObj->getSellIn();
                $item->quality = $itemObj->getQuality();
                return;
            }

            $this->updateItem($item);
        }
    }

    public function updateItem(Item $item): void
    {
        if ($item->name === 'Sulfuras, Hand of Ragnaros') {
            return;
        }

        $this->updateItemQuality($item);
        $this->updateSellin($item);
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
        if ($item->quality >= 50) {
            return;
        }

        // only Aged Brie and Backstage quality increases
        if ($item->name !== 'Aged Brie' && $item->name !== 'Backstage passes to a TAFKAL80ETC concert')
        {
            return;
        }

        $increment = 1;

        if ($item->name === 'Backstage passes to a TAFKAL80ETC concert' && $item->sellIn <= 10) {
            $increment = 2;
        }
        if ($item->name === 'Backstage passes to a TAFKAL80ETC concert' && $item->sellIn <= 5) {
            $increment = 3;
        }
        if ($item->name === 'Aged Brie' && $item->sellIn <= 0) {
            $increment = 2;
        }

        $newQuality = $item->quality + $increment;
        $item->quality = min($newQuality, 50);
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

        $decrement = ($item->sellIn <= 0) ? 2: 1;

        if ($item->quality > 0) {
            $item->quality = $item->quality - $decrement;
        }
    }

    /**
     * @param Item $item
     * @return void
     */
    public function updateItemQuality(Item $item): void
    {
        $this->incrementItemQuality($item);
        $this->decrementItemQuality($item);
    }
}
