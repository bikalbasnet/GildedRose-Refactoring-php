<?php

declare(strict_types=1);

namespace GildedRose\Item;

interface ItemInterface
{
    public function updateInventory(): void;
}
