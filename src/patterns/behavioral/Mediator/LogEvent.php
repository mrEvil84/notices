<?php

namespace PkowerzMacwro\GitSandbox\patterns\behavioral\Mediator;

class LogEvent implements EventType
{
    public function getName(): string
    {
        return 'LoggedEvent: event was logged';
    }
}
