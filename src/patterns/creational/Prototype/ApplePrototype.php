<?php

namespace PkowerzMacwro\GitSandbox\patterns\creational\Prototype;

use JetBrains\PhpStorm\Pure;

class ApplePrototype implements Prototype
{
    private string $name;

    private float $price;

    public function __construct(string $name, float $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    #[Pure] public function clone(): Prototype
    {
        return new self($this->name, $this->price);
    }
}
