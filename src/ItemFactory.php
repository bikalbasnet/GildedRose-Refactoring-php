<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Item\AgedBrie;
use GildedRose\Item\ItemInterface;

class ItemFactory
{
    public static function create(Item $item): ItemInterface
    {
        if ($item->name === 'Aged Brie') {
            return new AgedBrie($item->sellIn, $item->quality);
        }

//        if ($item->name === 'Backstage passes to a TAFKAL80ETC concert') {
//            return new BackstagePass($item);
//        }
//
//        if ($item->name === 'Sulfuras, Hand of Ragnaros') {
//            return new Sulfuras($item);
//        }
//
//        return new Standard($item);
    }
}
