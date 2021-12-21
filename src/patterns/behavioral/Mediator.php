<?php
// Mediator to behawioralny wzorzec projektowy pozwalający zredukować chaos zależności pomiędzy obiektami.
// Wzorzec ten ogranicza bezpośrednią komunikację pomiędzy obiektami i zmusza je do współpracy wyłącznie za pośrednictwem obiektu mediatora

//  Stosuj wzorzec Mediator gdy zmiana jakichś klas jest trudna z powodu ścisłego sprzęgnięcia z innymi klasami.
//  Stosuj ten wzorzec gdy nie możesz ponownie użyć jakiegoś komponentu w innym programie, z powodu zbytniej jego zależności od innych komponentów.
//  Stosuj wzorzec Mediator gdy zauważysz, że tworzysz mnóstwo podklas komponentu tylko aby móc ponownie użyć jakieś zachowanie w innych kontekstach.

interface EventType {
    public function getName();
}

class InsertToDbEvent implements EventType
{
    public function getName(): string
    {
        return 'writeToDbEvent';
    }
}

class UpdateToDbEvent implements EventType
{
    public function getName(): string
    {
        return 'updateToDbEvent';
    }
}

class ReadFromDbEvent implements EventType
{
    public function getName(): string
    {
        return 'readFromDbEvent';
    }

}

class LoggedEvent implements EventType
{
    public function getName(): string
    {
        return 'LoggedEvent: event was logged';
    }

}

interface Mediator
{
    public function notify(object $sender, EventType $event);
}

abstract class Component
{
    protected Mediator $mediator;

    public function setMediator(Mediator $mediator): void
    {
        $this->mediator = $mediator;
    }
}

class ChangeDataDbComponent extends Component
{
    private string $state;

    public function insertToDb(string $message): void
    {
        echo 'ChangeDataDbComponent: write to db: ' . $message . PHP_EOL;
        $this->mediator->notify($this, new InsertToDbEvent());
    }

    public function updateToDb(string $message): void
    {
        echo 'ChangeDataDbComponent: update to db: ' . $message . PHP_EOL;
        $this->mediator->notify($this, new UpdateToDbEvent());
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

class ChangeDbLogger extends Component
{
    public function notifyInsert(EventType $changeDbType): void
    {
        echo 'ChangeDbNotifier: data were inserted to db' . PHP_EOL;
        $this->mediator->notify($this, new LoggedEvent());
    }

    public function notifyUpdate(EventType $changeDbType): void
    {
        echo 'ChangeDbNotifier: data were updated in db' . PHP_EOL;
    }
}

class DbMediator implements Mediator
{
    private ChangeDataDbComponent $writer;
    private ChangeDbLogger $logger;
//    private

    public function __construct(ChangeDataDbComponent $writer, ChangeDbLogger $logger)
    {
        $this->writer = $writer;
        $this->writer->setMediator($this);

        $this->logger = $logger;
        $this->logger->setMediator($this);
    }


    public function notify(object $sender, EventType $event)
    {
        if ($event instanceof InsertToDbEvent) {
            $this->logger->notifyInsert($event);
            $this->writer->setState('data inserted.');
        }

        if ($event instanceof UpdateToDbEvent) {
            $this->logger->notifyUpdate($event);
        }

        if ($event instanceof LoggedEvent) {
            echo $event->getName() . PHP_EOL;
        }
    }
}

$writer = new ChangeDataDbComponent();
$logger = new ChangeDbLogger();

$mediator = new DbMediator($writer, $logger);

$writer->insertToDb('INSERT INTO test');
echo $writer->getState() . PHP_EOL;



