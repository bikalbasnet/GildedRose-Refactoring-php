<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Item\AgedBrie;
use GildedRose\Item\BackstagePasses;
use GildedRose\Item\ItemInterface;
use GildedRose\Item\Sulfuras;
use GildedRose\Item\StandardItem;

class ItemFactory
{
    public static function create(Item $item): ItemInterface
    {
        if ($item->name === 'Aged Brie') {
            return new AgedBrie($item->sellIn, $item->quality);
        }

        if ($item->name === 'Backstage passes to a TAFKAL80ETC concert') {
            return new BackstagePasses($item->sellIn, $item->quality);
        }

        if ($item->name === 'Sulfuras, Hand of Ragnaros') {
            return new Sulfuras($item->sellIn, $item->quality);
        }

        return new StandardItem($item->sellIn, $item->quality);
    }
}
