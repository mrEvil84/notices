<?php

namespace PkowerzMacwro\GitSandbox\patterns\creational\Prototype;

interface Prototype
{
    public function clone(): Prototype;
}