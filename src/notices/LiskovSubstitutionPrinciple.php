<?php


// przyklad zlamania zasady liskov


class Rectangle // prostokąt
{
    protected float $width;
    protected float $height;

    public function setWidth(float $width): void
    {
        $this->width = $width;
    }

    public function setHeight(float $height): void
    {
        $this->height = $height;
    }

    public function getArea(): float
    {
        return $this->width * $this->height;
    }
}

class Square extends Rectangle
{
    public function getArea(): float
    {
        return $this->height * $this->height; // naruszenie zasady, bo metoda w kl. pochodnej zmienia zachowanie klasy bazowej
    }
}

function compute(Rectangle $rectangle): float
{
    return $rectangle->getArea();
}

$width = 1.0;
$height = 2.0;

$rectangle = new Square();
$rectangle->setWidth($width);
$rectangle->setHeight($height);

$expectedArea = 2.0;

// naprawa naruszenia zasady liskov
if ($rectangle instanceof Square) {
    $expectedArea = 4.0;
}

var_dump(compute($rectangle) === $expectedArea); // tu jest naruszenie zasady bo wynik to 4 , a powinien byc 2 (bo nie wykonano metody nadrzednej tylko podrzedna)

// lub inna architektura

interface Figure
{
    public function getArea(): float;
}

class NewRectangle implements Figure
{
    private float $width;
    private float $height;

    public function getArea(): float
    {
        return $this->width * $this->height;
    }

    public function setWidth(float $width): void
    {
        $this->width = $width;
    }

    public function setHeight(float $height): void
    {
        $this->height = $height;
    }

}

class NewSquare implements Figure
{
    private float $sideLength;

    public function setSideLength(float $sideLength): void
    {
        $this->sideLength = $sideLength;
    }

    public function getArea(): float
    {
        return $this->sideLength ** 2; // pow($this->sideLength, 2);
    }
}

function compute2(Figure $figure): float
{
    return $figure->getArea();
}

$newSquare = new NewSquare();
$newSquare->setSideLength(3);
var_dump(compute2($newSquare));