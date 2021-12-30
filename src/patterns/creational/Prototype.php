<?php
// PROTOTYP
// Do zapamietania:   klonowanie delegowane do obiektow

// Prototyp to kreacyjny wzorzec projektowy, który umożliwia kopiowanie już istniejących obiektów
// bez tworzenia zależności pomiędzy twoim kodem, a klasami obiektów.
// Wzorzec projektowy Prototyp (!) deleguje proces klonowania samym obiektom, które mają być sklonowane

// Kiedy stosować ?
// 1. Stosuj wzorzec Prototyp gdy chcesz aby twój kod nie był zależny od konkretnej klasy kopiowanego obiektu.
// 2. Stosuj ten wzorzec gdy chcesz zredukować ilość podklas różniących się jedynie sposobem inicjalizacji swych obiektów.
// 3. Ktoś inny bowiem mógł stworzyć takie podklasy tylko w celu tworzenia obiektów o określonej konfiguracji.

// Zalety:
// 1. Możesz klonować obiekty bez konieczności sprzęgania ze szczegółami ich konkretnych klas.
// 2. Możesz pozbyć się wielokrotnie powtarzanego kodu inicjalizacyjnego na rzecz klonowania prefabrykowanych prototypów.
// 3. Dużo wygodniejsze produkowanie złożonych obiektów.
// 4. Podejście to stanowi alternatywę do dziedziczenia w przypadku gdy mamy
//    do czynienia z wcześniej zdefiniowanymi konfiguracjami złożonych obiektów.
//
// Wady:
// 1.  Klonowanie złożonych obiektów, które mają odniesienia cykliczne, może być trudne.


interface Prototype
{
    public function clone(): Prototype;
}

class ApplePrototype implements Prototype
{
    private string $name;
    private float $price;
    private string $color;

    public function __construct(string $name, float $price, string $color)
    {
        $this->name = $name;
        $this->price = $price;
        $this->color = $color;
    }

    public function clone(): Prototype
    {
        return new self($this->name, $this->price, $this->color);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getColor(): string
    {
        return $this->color;
    }
}

class ClientCloner
{
    private Prototype $prototype;

    public function __construct(Prototype $prototype)
    {
        $this->prototype = $prototype;
    }

    public function clone(): Prototype
    {
        return $this->prototype->clone();
    }
}


$cloner = new ClientCloner(new ApplePrototype('lobo', 10.2, 'red'));

$apples = [];
for($i =0 ; $i < 100; $i++) {
    $apples [] = $cloner->clone();
}

var_dump($apples);