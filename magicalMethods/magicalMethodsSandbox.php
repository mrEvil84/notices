<?php

class Vehicle
{
    public string $type;
    public int $number;


    public function __sleep() : array
    {
        return ['type', 'number'];
    }

    public function __wakeup() {
        echo '[ Unserialized : ]-> ' . $this->type . ' ' .$this->number . PHP_EOL;
    }

    public function __toString(): string
    {
        return 'Vehicle: ' . $this->type . 'number of items ' . $this->number ;
    }

    public function __invoke(): self // gdy traktujemy obiekt jako funkcję
    {
        $this->number = 200;
        return $this;
    }
}

$v1 = new Vehicle();
$v1->type = 'Car';
$v1->number = 100;
$serializedVehicle = serialize($v1);
$unserializedVehicle = unserialize($serializedVehicle);

var_dump($serializedVehicle);
var_dump($unserializedVehicle);
echo $v1 . PHP_EOL;

var_dump(
    ($v1)()
);