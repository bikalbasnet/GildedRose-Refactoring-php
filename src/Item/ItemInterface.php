<?php

namespace GildedRose\Item;

interface ItemInterface
{
    public function updateInventory(): void;

    public function getNewQuality(): int;

    public function updateSellin(): void;

    public function getQuality(): int;

    public function getSellIn(): int;
}
