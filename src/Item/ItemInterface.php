<?php

namespace GildedRose\Item;

interface ItemInterface
{
    public function updateItemQuality(): void;

    public function updateSellin(): void;

    public function getQuality(): int;

    public function getSellIn(): int;
}
