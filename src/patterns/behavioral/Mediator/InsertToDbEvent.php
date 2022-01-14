<?php

namespace PkowerzMacwro\GitSandbox\patterns\behavioral\Mediator;

class InsertToDbEvent implements EventType
{
    public function getName(): string
    {
        return 'writeToDbEvent';
    }
}