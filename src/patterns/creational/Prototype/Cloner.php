<?php

namespace PkowerzMacwro\GitSandbox\patterns\creational\Prototype;

class Cloner
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
