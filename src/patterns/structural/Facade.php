<?php
// Ukrywanie skompikowanego interfejsu obiektu i udostepnienie tylko potrzenych rzeczy

// Fasada jest strukturalnym wzorcem projektowym, który wyposaża bibliotekę, framework lub inny złożony zestaw klas w uproszczony interfejs.

// Zastosowanie:
//  1. Użyj wzorca Fasada gdy potrzebujesz ograniczonego, ale łatwego w użyciu interfejsu do złożonego podsystemu.
//  2. Stosuj Fasadę gdy chcesz ustrukturyzować podsystem w warstwy.

// Zalety:
// 1. Można odizolować kod od złożoności podsystemu.

// Wady :
// 1. Fasada może stać się boskim obiektem sprzężonym ze wszystkimi klasami aplikacji.



class Product
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}

class ProductsStorage
{
    public function getFromStorage(Product $product): void
    {
        echo 'Product storage get from storage : ' . $product->getName() . PHP_EOL;
    }
}

class OrdersSystem
{
    public function order(Product $product): void
    {
        echo 'Order system: order product: ' . $product->getName() . PHP_EOL;
    }
}

class Shop
{
    public function buy(Product $product): void
    {
        echo 'Shop buy a product: ' . $product->getName() . PHP_EOL;
    }
}

class InternetOrdersFacade
{
    private ProductsStorage $productsStorage;
    private OrdersSystem $ordersSystem;
    private Shop $shop;

    public function __construct(
        ProductsStorage $productsStorage,
        OrdersSystem $ordersSystem,
        Shop $shop
    ) {
        $this->productsStorage = $productsStorage;
        $this->ordersSystem = $ordersSystem;
        $this->shop = $shop;
    }

    public function buy(Product $p): void
    {
        echo 'Product buy : ' . PHP_EOL;
        $this->shop->buy($p);
        $this->ordersSystem->order($p);
        $this->productsStorage->getFromStorage($p);
    }
}

$p = new Product('szelki');
$iof = new InternetOrdersFacade(
    new ProductsStorage(),
    new OrdersSystem(),
    new Shop()
);
$iof->buy($p);