<?php

// MindTrigger: Struktury drzewiaste, pudełka z produktami w mniejszych pudełkach.

// Kompozyt to strukturalny wzorzec projektowy pozwalający komponować obiekty w struktury drzewiaste,
// a następnie traktować te struktury jakby były osobnymi obiektami.
//
// Kiedy stosowac ?
// 1. Stosuj wzorzec Kompozyt gdy, musisz zaimplementować drzewiastą strukturę obiektów.
// 2. Stosuj ten wzorzec gdy, chcesz, aby kod kliencki traktował zarówno proste, jak i złożone elementy jednakowo.
//
// Zalety:
// 1. Można pracować ze skomplikowanymi strukturami drzewiastymi w wygodny sposób: wykorzystaj na swoją korzyść polimorfizm i rekursję.
// 2. Zasada otwarte/zamknięte. Możesz wprowadzać do programu obsługę nowych typów elementów bez psucia istniejącego kodu, gdyż pracuje on teraz z drzewem różnych obiektów.
//
// Wady:
// 1. Ustalenie wspólnego interfejsu dla klas o diametralnie różnych funkcjonalnościach może okazać się trudne.
//  W pewnych przypadkach trzeba przesadnie uogólnić interfejs komponentu, co uczyni go trudniejszym do zrozumienia.

interface Product
{
    public function getPrice(): float;
    public function getName(): string;
}

class Apple implements Product
{
    private float $price;

    public function getPrice(): float
    {
        return 12.50;
    }
    public function getName(): string
    {
        return 'apple';
    }
}

class Car implements Product
{
    public function getPrice(): float
    {
        return 1234.56;
    }

    public function getName(): string
    {
        return 'awesome car';
    }
}


class PackageComposite implements Product // klasa kompozyt , posiada w sobie inne produkty (obiekty)
{
    /**
     * @var Product[]
     */
    private array $products;

    public function add(Product $p)
    {
        $this->products [] = $p;
    }

    public function getPrice(): float
    {
        $packagePrice = 0;
        /** @var Product $product */
        foreach ($this->products as $product) {
            $packagePrice += $product->getPrice();
        }

        return $packagePrice;
    }
    public function getName(): string
    {
        return 'Package';
    }
}

$packageSmall = new PackageComposite();
$packageSmall->add(new Apple());
$packageSmall->add(new Apple());
$packageSmall->add(new Apple());

$packageBig = new PackageComposite();
$packageBig->add($packageSmall);
$packageBig->add(new Apple());
$packageBig->add(new Car());

echo 'Price package small : ' . $packageSmall->getPrice() . PHP_EOL;
echo 'Price package big : ' . $packageBig->getPrice() . PHP_EOL;
