<?php

namespace PkowerzMacwro\GitSandbox\patterns\behavioral\Mediator;

abstract class Component
{
    protected Mediator $mediator;

    public function setMediator(Mediator $mediator): void
    {
        $this->mediator = $mediator;
    }
}