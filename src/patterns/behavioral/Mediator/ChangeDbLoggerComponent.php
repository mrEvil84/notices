<?php

namespace PkowerzMacwro\GitSandbox\patterns\behavioral\Mediator;

class ChangeDbLoggerComponent extends Component
{
    public function notifyInsert(EventType $changeDbType): void
    {
        echo 'ChangeDbNotifier: data were inserted to db' . PHP_EOL;
        $this->mediator->notify(new LogEvent());
    }

    public function notifyUpdate(EventType $changeDbType): void
    {
        echo 'ChangeDbNotifier: data were updated in db' . PHP_EOL;
        $this->mediator->notify(new UpdateToDbEvent());
    }
}
