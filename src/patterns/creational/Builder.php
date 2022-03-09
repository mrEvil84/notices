<?php

//Budowniczy jest kreacyjnym wzorcem projektowym,
// który daje możliwość tworzenia złożonych obiektów etapami,
// krok po kroku.

// Wzorzec ten pozwala produkować różne typy oraz reprezentacje obiektu używając tego samego kodu konstrukcyjnego.
// Wzorzec Budowniczy pozwala konstruować złożone obiekty krok po kroku.
// Budowniczy ponadto nie pozwala na dostęp do nich innym obiektom, dopóki nie zostaną ukończone.

// Istotne jest to, że nie musisz wywoływać wszystkich etapów. Możesz bowiem ograniczyć się tylko do tych kroków,
// które są niezbędne do określenia potrzebnej nam konfiguracji obiektu.

// Kiedy używać:
// 1. Stosuj wzorzec Budowniczy, aby pozbyć się “teleskopowych konstruktorów”.
// 2. Stosuj wzorzec Budowniczy, gdy potrzebujesz możliwości tworzenia różnych reprezentacji jakiegoś produktu
//    (na przykład, domy z kamienia i domy z drewna).
// 3. Stosuj ten wzorzec do konstruowania drzew Kompozytowych lub innych złożonych obiektów.

// Zalety:
// 1. Możesz konstruować obiekty etapami, odkładać niektóre etapy, lub wykonywać je rekursywnie.
// 2. Możesz wykorzystać ponownie ten sam kod konstrukcyjny budując kolejne reprezentacje produktów.
// 3. OCP, Zasada pojedynczej odpowiedzialności.
//    Można odizolować skomplikowany kod konstrukcyjny od logiki biznesowej produktu.

// Wady:
// 1. Kod staje się bardziej skomplikowany, gdyż wdrożenie tego wzorca wiąże się z dodaniem wielu nowych klas.

interface Product {}

class Car implements Product
{
    private ?string $engine;
    private ?string $wheels;
    private ?string $seats;
    private ?string $gps;
    private bool $isReady;

    public function setEngine(string $engine): void
    {
        $this->engine = $engine;
    }

    public function setWheels(string $wheels): void
    {
        $this->wheels = $wheels;
    }

    public function setSeats(string $seats): void
    {
        $this->seats = $seats;
    }

    public function setGps(string $gps): void
    {
        $this->gps = $gps;
    }

    public function isReady(): bool
    {
        return !empty($this->engine)
            && !empty($this->wheels)
            && !empty($this->seats)
            && !empty($this->gps);
    }

    public function __toString(): string
    {
        return $this->engine . ' : ' . $this->wheels . ' : ' . $this->seats . ' : ' . $this->gps . PHP_EOL;
    }
}

class CarManual implements Product
{
    private string $manual;

    public function setData(Car $car)
    {
        $this->manual = $car->__toString();
    }

    public function getManual(): string
    {
        return $this->manual;
    }
}

interface Builder
{
    public function reset(): void;
    public function setEngine(string $engine): void;
    public function setWheels(string $wheels): void;
    public function setSeats(string $seats): void;
    public function setGps(string $gps): void;
    public function getResult(): ?Product;
}

class CarBuilder implements Builder
{
    private Car $car;

    public function __construct()
    {
        $this->car = new Car();
    }

    public function reset(): void
    {
        unset($this->car);
        $this->car = new Car();
    }

    public function setEngine(string $engine): void
    {
        $this->car->setEngine($engine);
    }

    public function setWheels(string $wheels): void
    {
        $this->car->setWheels($wheels);
    }

    public function setSeats(string $seats): void
    {
        $this->car->setSeats($seats);
    }

    public function setGps(string $gps): void
    {
        $this->car->setGps($gps);
    }

    public function getResult(): ?Product
    {
        if ($this->car->isReady()) {
            return $this->car;
        }
        return null;
    }
}

class ManualCarBuilder implements Builder
{
    private CarManual $carManual;
    private Car $car;

    public function reset(): void
    {
        unset($this->carManual);
        $this->carManual = new CarManual();
    }

    public function setEngine(string $engine): void
    {
        $this->car->setEngine($engine);
    }

    public function setWheels(string $wheels): void
    {
        $this->car->setWheels($wheels);
    }

    public function setSeats(string $seats): void
    {
        $this->car->setSeats($seats);
    }

    public function setGps(string $gps): void
    {
        $this->car->setGps($gps);
    }

    public function getResult(): ?Product
    {
       return $this->carManual;
    }
}

class CarPackage
{
    private Car $car;
    private CarManual $manual;

    public function __construct(Car $car, CarManual $manual)
    {
        $this->car = $car;
        $this->manual = $manual;
    }

    public function getCar(): Car
    {
        return $this->car;
    }

    public function getManual(): CarManual
    {
        return $this->manual;
    }
}

// klasa dyrektora , przyjmuje budowniczych aby nimi zarzadzac i uzyskac porzadany set obiektow
class CarDirector
{
    private Builder $carBuilder;
    private Builder $manualBuilder;

    public function __construct(Builder $carBuilder, Builder $manualBuilder)
    {
        $this->carBuilder = $carBuilder;
        $this->manualBuilder = $manualBuilder;
    }

    private function makeSuvCar(): ?Product
    {
        $this->carBuilder->reset();
        $this->carBuilder->setEngine('4.1 HP');
        $this->carBuilder->setWheels('18 inces');
        $this->carBuilder->setSeats('4+2');
        $this->carBuilder->setGps('TomTom 4000');
        return $this->carBuilder->getResult();
    }

    private function makeSuvManual(Car $car): Product
    {
        $this->manualBuilder->reset();
        /** @var CarManual $carManual */
        $carManual = $this->manualBuilder->getResult();
        $carManual->setData($car);
        return $carManual;
    }

    public function deliverSuvPackage(): CarPackage
    {
        $car = $this->makeSuvCar();
        $manual = $this->makeSuvManual($car);

        return new CarPackage($car, $manual);
    }
}

$carDirector = new CarDirector(new CarBuilder(), new ManualCarBuilder());

var_dump(
    $carDirector->deliverSuvPackage()
);
