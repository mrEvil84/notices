<?php

namespace PkowerzMacwro\GitSandbox\patterns\behavioral\Mediator;

class DbMediator implements Mediator
{
    private ChangeDataDbComponent $writer;
    private ChangeDbLogger $logger;

    public function __construct(ChangeDataDbComponent $writer, ChangeDbLogger $logger)
    {
        $this->writer = $writer;
        $this->writer->setMediator($this);

        $this->logger = $logger;
        $this->logger->setMediator($this);
    }

    public function notify(object $sender, EventType $event): void
    {
        if ($event instanceof InsertToDbEvent) {
            $this->logger->notifyInsert($event);
            $this->writer->setState('data inserted.');
            echo $this->writer->getState() . PHP_EOL;
        }

        if ($event instanceof UpdateToDbEvent) {
            $this->logger->notifyUpdate($event);
            $this->writer->setState('data updated.');
            echo $this->writer->getState() . PHP_EOL;
        }

        if ($event instanceof LogEvent) {
            echo $event->getName() . PHP_EOL;
            $this->writer->setState('data logged.');
            echo $this->writer->getState() . PHP_EOL;
        }
    }
}
