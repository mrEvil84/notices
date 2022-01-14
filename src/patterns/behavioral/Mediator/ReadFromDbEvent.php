<?php

namespace PkowerzMacwro\GitSandbox\patterns\behavioral\Mediator;

class ReadFromDbEvent implements EventType
{
    public function getName(): string
    {
        return 'readFromDbEvent';
    }
}