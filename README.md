# GildedRose Kata - PHP Version (Solution)

This is a solution to the [GildedRose Kata](https://github.com/emilybache/GildedRose-Refactoring-Kata/tree/main/php) in PHP.


## Installation

Clone the repository:
```sh
git clone git@github.com:bikalbasnet/GildedRose-Refactoring-php.git
```

Install all the dependencies using composer

```shell script
cd ./GildedRose-Refactoring-php
composer install
```

## Dependencies

The project uses composer to install:

- [PHPUnit](https://phpunit.de/)
- [ApprovalTests.PHP](https://github.com/approvals/ApprovalTests.php)
- [PHPStan](https://github.com/phpstan/phpstan)
- [Easy Coding Standard (ECS)](https://github.com/symplify/easy-coding-standard)

### commands
```shell
componser tests
composer phpstan
composer check-cs
composer fix-cs
```

## Solution Explanation
You can check the commits at https://github.com/bikalbasnet/GildedRose-Refactoring-php/commits/main, which are the steps I took to refactor the code.
1. The [first commit](https://github.com/bikalbasnet/GildedRose-Refactoring-php/commit/74d7ca5a478942e6c7c9f01d65462b262b8ad527) is the original code from the GildedRose repository.
2. After that, I added the tests for the existing code and fixed coding standard and phpstan issues. These are the commits: [Add phpunit tests](https://github.com/bikalbasnet/GildedRose-Refactoring-php/commit/4c47874667b8e602f41fcb69b4641bcf0ca3f009) and [Fix phpcs, phpstan issue](https://github.com/bikalbasnet/GildedRose-Refactoring-php/commit/4a192854f8bf16c756d4658628f55b59cbe4a3b2).
3. This is the step where the actual refactoring began (Check the commits [Make code slightly simple by reducing nested if statements](https://github.com/bikalbasnet/GildedRose-Refactoring-php/commit/28a6552706fef997e3660beae44f6cfba6ff51b1) and [Remove more nested if statements](https://github.com/bikalbasnet/GildedRose-Refactoring-php/commit/61f59cb5e9172555ff5a8a3e8b12cfda2fdb1694)). I have tried to make the code more readable and simple by removing nested if statements without breaking any existing tests. 
4. With this, I am left with simple functions like `$this->incrementItemQuality($item);` and `$this->decrementItemQuality($item);` which can be easily refactored to a single function. This is what I exactly did in these commits: [Combine all increment quality in one function
   ](https://github.com/bikalbasnet/GildedRose-Refactoring-php/commit/450fdcd30c49de5741be550d008c1d9f576bc44b) and [combine multiple decrement item quality into one function] (https://github.com/bikalbasnet/GildedRose-Refactoring-php/commit/3e3699058ada6c3ea0f1a8def6eb831a94cb10cb)
5. Up until this point the code is much simpler, however there were still lot of if else condition which were handling different cases for different types of item. So I decided to use strategy pattern to make the code more readable and maintainable. This is the commit where I started implementing it [Implement strategy pattern to make code more readable and maintainable](https://github.com/bikalbasnet/GildedRose-Refactoring-php/commit/aafb197fdf35007875b34639e505a20f8cf615ec) and [Add object for all item type](https://github.com/bikalbasnet/GildedRose-Refactoring-php/commit/b20a5b693624f38fce3e8403150064d632848545). 
6. I created an Item class for each item type, example AgedBrie, BackstagePasses, etc. I realized that I was repeating some code and this can be further refactored. So I created a parent class Item that contains the common code for all the items. This is the commit [Reduce code by having each item object implement parent class](https://github.com/bikalbasnet/GildedRose-Refactoring-php/commit/2e82dd63938645b887a2faa630e315f4dcd3a168).
7. I was still repeating some code in parent class like maximum quality that is allowed, so I decided to create an abstract class, which will be implemented by all Item classes. Each item would then have to implement an abstract function `getNewQuality` because every item has its own logic on quality. The value which is obtained from this function is passed to `updateInventory`, which makes sure that the quality is not higher than allowed `50`. But Sulfurus is the only item that can have quality `80`, So I created a function `getHighestQuality`, which is overridden by `Sulfurus` Item to be `80`, whereas it defaults to `50`. This is the commit [Use Abstract class to reuse common logic like max quality values](https://github.com/bikalbasnet/GildedRose-Refactoring-php/commit/8b433b0048d2ab7ec741ee9c978dca7b25abca5f)
8. I furthered refactored the code by removing interface methods that are not needed and kept only one method `updateInventory` in the interface. This is the commit [Remove interfaces methods that are not needed](https://github.com/bikalbasnet/GildedRose-Refactoring-php/commit/d59290991958bfc2f1ab58f1e278619775ab7909).
9. After refactoring upto this stage , adding a new Item was very easy. Whenever a new item was added we only have to extend it from `AbstractItem` class and implement its own `getNewQuality` function. This is the commit [Add Conjured Item](https://github.com/bikalbasnet/GildedRose-Refactoring-php/commit/32ac95496bad36857239ddaad4533abc6edbe2ac). 
