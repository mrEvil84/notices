<?php

namespace PkowerzMacwro\GitSandbox\patterns\behavioral\Mediator;

class ChangeDataDbComponent extends Component
{
    private string $state;

    public function insertToDb(string $message): void
    {
        echo 'ChangeDataDbComponent: write to db: ' . $message . PHP_EOL;
        $this->mediator->notify(new InsertToDbEvent());
    }

    public function updateToDb(string $message): void
    {
        echo 'ChangeDataDbComponent: update to db: ' . $message . PHP_EOL;
        $this->mediator->notify(new UpdateToDbEvent());
    }

    public function setState(string $state): void
    {
        $this->state = $state . ' at ' . date('Y-m-d H:i:s');
    }

    public function getState(): string
    {
        return $this->state;
    }
}
