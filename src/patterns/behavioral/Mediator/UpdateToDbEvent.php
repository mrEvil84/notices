<?php

namespace PkowerzMacwro\GitSandbox\patterns\behavioral\Mediator;

class UpdateToDbEvent implements EventType
{
    public function getName(): string
    {
        return 'readFromDbEvent';
    }
}