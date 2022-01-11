<?php
// Mediator to behawioralny wzorzec projektowy pozwalający zredukować chaos zależności pomiędzy obiektami.
// Wzorzec ten ogranicza bezpośrednią komunikację pomiędzy obiektami i zmusza je do współpracy wyłącznie za pośrednictwem obiektu mediatora

//  Stosuj wzorzec Mediator gdy zmiana jakichś klas jest trudna z powodu ścisłego sprzęgnięcia z innymi klasami.
//  Stosuj ten wzorzec gdy nie możesz ponownie użyć jakiegoś komponentu w innym programie, z powodu zbytniej jego zależności od innych komponentów.
//  Stos

// MT: analogia z życia wieża kontroli lotów oraz samoloty w przestrzeni kontrolowanej przez wieżę
// MT: samoloty komunikuja sie ze soba za pomoca wiezy kontroli lotow ale nie wzajemnie




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

interface Mediator
{
    public function notify(object $sender, EventType $event);
}

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

    public function notify(object $sender, EventType $event)
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

        if ($event instanceof LoggedEvent) {
            echo $event->getName() . PHP_EOL;
            $this->writer->setState('data logged.');
            echo $this->writer->getState() . PHP_EOL;
        }
    }
}

$writer = new ChangeDataDbComponent();
$logger = new ChangeDbLogger();

$mediator = new DbMediator($writer, $logger);

$writer->insertToDb('INSERT INTO test');
$writer->updateToDb('UPDATE abc ');



