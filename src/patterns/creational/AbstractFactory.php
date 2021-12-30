<?php

// fabryka abstrakcyjna pozwala tworzyć rodziny spokrewnionych ze sobą obiektow bez okreslania konkretnych klas
// np. fabryka mebli, -> fabrykka krzeseł -> (krzesło art-deco, krzesło wiktoriańskie, krzesło nowoczesne itd.)
// produkowanie rodzin obiektow

// Kiedy stosowac :
// 1. Stosuj Fabrykę abstrakcyjną, gdy twój kod ma działać na produktach z różnych rodzin,
// ale jednocześnie nie chcesz, aby ściśle zależał od konkretnych klas produktów.
// Mogą one bowiem być nieznane na wcześniejszym etapie tworzenia programu,
// albo chcesz umożliwić przyszłą rozszerzalność aplikacji.
//
// Zalety :
// 1. Zyskujesz pewność, że produkty, jakie otrzymujesz stosując fabrykę, są ze sobą kompatybilne.
// 2. Zapobiegasz ścisłemu sprzęgnięciu konkretnych produktów z kodem klienckim.
// 3. SRP, Zasada pojedynczej odpowiedzialności. Możesz zebrać kod kreacyjny produktów w jednym miejscu w programie, ułatwiając tym samym późniejsze utrzymanie kodu.
// 4. Zasada otwarte/zamknięte. Możesz wprowadzać wsparcie dla nowych wariantów produktów bez psucia istniejącego kodu klienckiego.
//
// Wady :
// 1. Kod może stać się bardziej skomplikowany, niż powinien. Wynika to z konieczności wprowadzenia wielu nowych interfejsów i klas w toku wdrażania tego wzorca projektowego.
//
interface Chair // this is abstract factory
{
    public function getName(): string;
    public function hasLegs(): bool;
}

interface Table
{
    public function getName(): string;
    public function getLegsCount(): int;
}

class VictorianChair implements Chair
{
    private string $name = 'VictorianChair';

    public function getName(): string
    {
        return $this->name;
    }

    public function hasLegs(): bool
    {
        return true;
    }
}

class VictorianTable implements Table
{
    private string $name = 'VictorianTable';

    public function getLegsCount(): int
    {
        return 4;
    }

    public function getName(): string
    {
        return $this->name;
    }
}

interface FurnitureFactory
{
    public function createChair(): Chair;
    public function createTable(): Table;
}

class VictorianFurnitureFactory implements FurnitureFactory
{
    public function createChair(): VictorianChair
    {
        return new VictorianChair();
    }

    public function createTable(): Table
    {
        return new VictorianTable();
    }
}

class Client
{
    private FurnitureFactory $furnitureFactory;

    public function __construct(FurnitureFactory $furnitureFactory)
    {
        $this->furnitureFactory = $furnitureFactory;
    }

    public function getChair(): Chair
    {
        return $this->furnitureFactory->createChair();
    }

    public function getTable(): Table
    {
        return $this->furnitureFactory->createTable();
    }
}

$client = new Client(new VictorianFurnitureFactory());

var_dump($client->getChair());
var_dump($client->getTable());