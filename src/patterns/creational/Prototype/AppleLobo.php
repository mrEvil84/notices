<?php

namespace PkowerzMacwro\GitSandbox\patterns\creational\Prototype;

use JetBrains\PhpStorm\Pure;

class AppleLobo implements Prototype
{
    private string $name;

    private float $price;

    public function __construct(string $name, float $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function clone(): Prototype
    {
        return new self($this->name, $this->price);
    }
}
