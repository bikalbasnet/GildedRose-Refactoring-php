<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Item\AgedBrie;
use GildedRose\Item\BackstagePasses;
use GildedRose\Item\Conjured;
use GildedRose\Item\ItemInterface;
use GildedRose\Item\Sulfuras;
use GildedRose\Item\StandardItem;

class InventoryItemFactory
{
    public static function create(Item $item): ItemInterface
    {
        return match ($item->name) {
            default => new StandardItem($item),
            'Aged Brie' => new AgedBrie($item),
            'Backstage passes to a TAFKAL80ETC concert' => new BackstagePasses($item),
            'Sulfuras, Hand of Ragnaros' => new Sulfuras($item),
            'Conjured Mana Cake' => new Conjured($item),
        };
    }
}
