<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testStandardItemQualityDecreasesSellinDecreasesEachDay(): void
    {
        $startingSellin = 5;
        $startingQuality = 7;
        $standardItem = new Item('Elixir of the Mongoose', $startingSellin, $startingQuality);
        $subject = new GildedRose([$standardItem]);

        $subject->updateInventory();

        $this->assertEquals($startingSellin - 1, $standardItem->sellIn);
        $this->assertEquals($startingQuality - 1, $standardItem->quality);
    }

    public function testMultipleItemsDegradeEachDay(): void
    {
        $firstItem = new Item('First Standard Item', 5, 4);
        $secondItem = new Item('Second Standard Item', 3, 2);
        $subject = new GildedRose([$firstItem, $secondItem]);

        $subject->updateInventory();

        $this->assertEquals(4, $firstItem->sellIn);
        $this->assertEquals(3, $firstItem->quality);
        $this->assertEquals(2, $secondItem->sellIn);
        $this->assertEquals(1, $secondItem->quality);
    }

    public function testItemQualityDegradesTwiceAsFastPastSellinDate(): void
    {
        $item = new Item('Standard Item', -1, 4);
        $subject = new GildedRose([$item]);

        $subject->updateInventory();

        $this->assertEquals(2, $item->quality);
    }

    public function testItemQualityDegradesByOneWithOneDayLeft(): void
    {
        $item = new Item('Standard Item', 1, 4);
        $subject = new GildedRose([$item]);

        $subject->updateInventory();

        $this->assertEquals(3, $item->quality);
    }

    public function testItemQualityDegradesDownToZero(): void
    {
        $item = new Item('Standard Item', 4, 1);
        $subject = new GildedRose([$item]);

        $subject->updateInventory();

        $this->assertEquals(0, $item->quality);
    }

    public function testItemQualityIsNeverNegative(): void
    {
        $item = new Item('First Standard Item', 4, 0);
        $subject = new GildedRose([$item]);

        $subject->updateInventory();

        $this->assertEquals(0, $item->quality);
    }

    public function testAgedItemsIncreaseInQualityOverTime(): void
    {
        $item = new Item('Aged Brie', 5, 6);
        $subject = new GildedRose([$item]);

        $subject->updateInventory();

        $this->assertEquals(7, $item->quality);
    }

    public function testAgedItemQuality49IncreasesUpTo50(): void
    {
        $item = new Item('Aged Brie', 5, 49);
        $subject = new GildedRose([$item]);

        $subject->updateInventory();

        $this->assertEquals(50, $item->quality);
    }

    public function testAgedItemQualityIsNeverGreaterThan50WhenSellinIsNegative(): void
    {
        $item = new Item('Aged Brie', -1, 49);
        $subject = new GildedRose([$item]);

        $subject->updateInventory();

        $this->assertEquals(50, $item->quality);
    }

    public function testQualityOfAnItemIsNeverGreaterThan50(): void
    {
        $item = new Item('Aged Brie', 5, 50);
        $subject = new GildedRose([$item]);

        $subject->updateInventory();

        $this->assertEquals(50, $item->quality);
    }

    public function testAgedItemQualityIncreasesTwiceAsFastPastSellinDate(): void
    {
        $item = new Item('Aged Brie', 0, 6);
        $subject = new GildedRose([$item]);

        $subject->updateInventory();

        $this->assertEquals(8, $item->quality);
    }

    public function testAgedItemQuality50PastSellInDateDoesNotIncrease(): void
    {
        $item = new Item('Aged Brie', 0, 50);
        $subject = new GildedRose([$item]);

        $subject->updateInventory();

        $this->assertEquals(50, $item->quality);
    }

    public function testLegendaryItemsNeverHaveToBeSold(): void
    {
        $item = new Item('Sulfuras, Hand of Ragnaros', -1, 80);
        $subject = new GildedRose([$item]);

        $subject->updateInventory();

        $this->assertEquals(-1, $item->sellIn);
    }

    public function testLegendaryItemsNeverDecreaseInQuality(): void
    {
        $item = new Item('Sulfuras, Hand of Ragnaros', -1, 80);
        $subject = new GildedRose([$item]);

        $subject->updateInventory();

        $this->assertEquals(80, $item->quality);
    }

    public function testBackstagePassesIncreaseInQualityAsSellInDateApproaches(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 15, 20);
        $subject = new GildedRose([$item]);

        $subject->updateInventory();

        $this->assertEquals(21, $item->quality);
    }

    public function testBackstagePassesIncreaseInQualityBy1WhenThereAre10DaysOrLess(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 11, 48);
        $subject = new GildedRose([$item]);

        $subject->updateInventory();

        $this->assertEquals(49, $item->quality);
    }

    public function testBackstagePassesIncreaseInQualityBy2WhenThereAre10DaysOrLess(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 10, 20);
        $subject = new GildedRose([$item]);

        $subject->updateInventory();

        $this->assertEquals(22, $item->quality);
    }

    public function testBackstagePassesQuality49IncreaseUpTo50WhenThereAre10DaysOrLess(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 10, 49);
        $subject = new GildedRose([$item]);

        $subject->updateInventory();

        $this->assertEquals(50, $item->quality);
    }

    public function testBackstagePassesIncreaseInQualityBy2WhenThereAre6DayOrLess(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 6, 20);
        $subject = new GildedRose([$item]);

        $subject->updateInventory();

        $this->assertEquals(22, $item->quality);
    }

    public function testBackstagePassesIncreaseInQualityBy3WhenThereAre5DaysOrLess(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 5, 20);
        $subject = new GildedRose([$item]);

        $subject->updateInventory();

        $this->assertEquals(23, $item->quality);
    }

    public function testBackstagePassesQuality49IncreaseUpTo50WhenThereAre5DaysOrLess(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 5, 49);
        $subject = new GildedRose([$item]);

        $subject->updateInventory();

        $this->assertEquals(50, $item->quality);
    }

    public function testBackstagePassesQuality50IncreaseUpTo50WhenThereAre5DaysOrLess(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 5, 50);
        $subject = new GildedRose([$item]);

        $subject->updateInventory();

        $this->assertEquals(50, $item->quality);
    }

    public function testBackstagePassesQualityDropsToZeroAfterTheConcert(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 0, 20);
        $subject = new GildedRose([$item]);

        $subject->updateInventory();

        $this->assertEquals(0, $item->quality);
    }

    public function testConjuredItemsDegradedTwiceAsFast(): void
    {
        $item = new Item('Conjured Mana Cake', 3, 6);
        $subject = new GildedRose([$item]);

        $subject->updateInventory();

        $this->assertEquals(4, $item->quality);
    }

    public function testConjuredItemsQualityStaysAtZeroAfterSellInDate(): void
    {
        $item = new Item('Conjured Mana Cake', -3, 0);
        $subject = new GildedRose([$item]);

        $subject->updateInventory();

        $this->assertEquals(0, $item->quality);
        $this->assertEquals(-4, $item->sellIn);
    }
}
