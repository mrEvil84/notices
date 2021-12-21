<?php

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

abstract class Plant {

    protected Product $product;

    protected string $plantCode;

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

class CarPlantPoland extends Plant
{
    public function __construct()
    {
        $this->plantCode = 'pl';
    }

    public function createProduct(): Product
    {
        $car = new Car();
        $this->product = $car;

        return $car;
    }
}

$plant = new CarPlantPoland();
$car = $plant->createProduct();

print_r ('Plant : ' . $plant->getPlantCode() . ' : manufactured car name: ' . $plant->getProduct()->getName() . ' car do stuff : ' .  $car->doStuff() );

