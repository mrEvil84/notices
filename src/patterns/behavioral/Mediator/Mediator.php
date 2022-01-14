<?php

namespace PkowerzMacwro\GitSandbox\patterns\behavioral\Mediator;

interface Mediator
{
    public function notify(object $sender, EventType $event);
}
