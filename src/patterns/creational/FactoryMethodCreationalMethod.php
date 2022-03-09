<?php
// CreationalMethod, FactoryMethod

// Metoda wytwórcza jest kreacyjnym wzorcem projektowym,
// który udostępnia interfejs do tworzenia obiektów w ramach klasy bazowej,
// ale pozwala podklasom zmieniać typ tworzonych obiektów.
// Wzorzec projektowy Metody wytwórczej proponuje zamianę bezpośrednich wywołań konstruktorów obiektów
// (wykorzystujących operator new) na wywołania specjalnej metody wytwórczej

// Kiedy stosowac :
// 1. Stosuj Metodę Wytwórczą gdy, nie wiesz jakie typy obiektów pojawią się w twoim programie i jakie
//    będą między nimi zależności.
// 2. Korzystaj z Metody Wytwórczej gdy, zamierzasz pozwolić użytkującym twą bibliotekę lub
//    framework rozbudowywać jej wewnętrzne komponenty.
// 3. Korzystaj z Metody wytwórczej gdy, chcesz oszczędniej wykorzystać zasoby systemowe poprzez ponowne wykorzystanie
//    już istniejących obiektów, zamiast odbudowywać je raz za razem.

// Zalety:
// 1. Unikasz ścisłego sprzęgnięcia pomiędzy twórcą a konkretnymi produktami.
// 2. Zasada pojedynczej odpowiedzialności. Możesz przenieść kod kreacyjny produktów w jedno miejsce programu, ułatwiając tym samym utrzymanie kodu.
// 3. Zasada otwarte/zamknięte. Możesz wprowadzić do programu nowe typy produktów bez psucia istniejącego kodu klienckiego.

// Wady:
// 1. Kod może się skomplikować, ponieważ aby zaimplementować wzorzec, musisz utworzyć liczne podklasy.
// W najlepszej sytuacji wprowadzisz ów wzorzec projektowy do już istniejącej hierarchii klas kreacyjnych.

interface Product
{
    public function doStuff(): string;
    public function getName(): string;
}

class Car implements Product {

    public function doStuff(): string
    {
        return 'pl-car-do-stuff';
    }

    public function getName(): string
    {
        return 'pl-car-product';
    }

    public function __set($name, $value)
    {
        echo 'Property : ' . $name . ' not exists , value = ' . $value;
    }

    public function __get($name)
    {
        echo 'Propery ' . $name . 'not exits ';
    }
}

class Motorcycle implements Product
{
    public function doStuff(): string
    {
        return 'Motorcycle do stuff';
    }

    public function getName(): string
    {
        return 'motorcycle';
    }
}

abstract class Plant {

    protected Product $product;

    protected string $plantCode;

    // this is factory method
    abstract public function createProduct(): Product;

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getPlantCode(): string
    {
        return $this->plantCode;
    }
}

// concrete creator
class VehiclePlantPoland extends Plant
{
    public function __construct()
    {
        $this->plantCode = 'pl01';
    }

    public function createProduct(): Product
    {
        $car = new Car();
        $this->product = $car;

        return $car;
    }
}

class MotorcyclePlantPoland extends Plant
{

    public function __construct()
    {
        $this->plantCode = 'pl02';
    }

    public function createProduct(): Product
    {
        $moto = new Motorcycle();
        $this->product = $moto;

        return $moto;
    }
}



$plant01 = new VehiclePlantPoland();
$car = $plant01->createProduct();

$plant02 = new MotorcyclePlantPoland();
$moto = $plant02->createProduct();

print_r ('Plant : ' . $plant01->getPlantCode() . ' : manufactured car name: ' . $plant01->getProduct()->getName() . ' car do stuff : ' .  $car->doStuff() );
print_r ('Plant : ' . $plant02->getPlantCode() . ' : manufactured car name: ' . $plant02->getProduct()->getName() . ' car do stuff : ' .  $moto->doStuff() );

