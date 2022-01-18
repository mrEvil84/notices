<?php

//
// dla danego zdarzenia rejestwoany jest listener ktory obsluguje dane zdarzenie
//

// Obserwator to czynnościowy (behawioralny) wzorzec projektowy pozwalający zdefiniować mechanizm subskrypcji
// w celu powiadamiania wielu obiektów o zdarzeniach dziejących się w obserwowanym obiekcie.
//
// Kiedy stosować wzorzec ?
//
// 1.  Stosuj wzorzec Obserwator gdy zmiany stanu jednego obiektu mogą wymagać zmiany w innych obiektach,
// a konkretny zestaw obiektów nie jest zawczasu znany lub ulega zmianom dynamicznie.
// 2.  Stosuj ten wzorzec gdy, jakieś obiekty w twojej aplikacji muszą obserwować inne,
// ale tylko przez jakiś czas lub w niektórych przypadkach.
//
// Zalety:
//
// 1. Zachwoje zasade OCP (Open Closed Principle) można wprowadzac nowe funkcjonalnosci np. nowe klasy listenerow nie
//  zmieniajac innych
// 2. Można utworzyć związek pomiędzy obiektami w trakcie działania programu.
//
// Wady:
//
// 1. Subskrybenci powiadamini są w przypadkowy sposob
//

interface Listener // Observer.Event-Subscriber,Listener
{
    public function update(string $message): void;
}

interface EventType
{
    public function getName(): string;
}

abstract class Event implements EventType
{
    private string $message;

    public function addMessage(string $message)
    {
        $this->message = $message;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getName(): string
    {
        return get_class($this);
    }
}

class StoreDataInDbEvent extends Event
{
}

class FetchDataFromDbEvent extends Event
{
}

class EmailAlertsListener implements Listener
{
    public function update(string $message): void
    {
        echo 'EAL: a message ' . $message . PHP_EOL;
    }
}

class SmsAlertsListener implements Listener
{
    public function update(string $message): void
    {
        echo 'SAL: a message ' . $message . PHP_EOL;
    }
}

class LoggingAlertsListener implements Listener
{
    public function update(string $message): void
    {
        echo 'LAL:  a message ' . $message . PHP_EOL;
    }
}

class EventManager // publisher
{
    private array $listeners = [];

    public function subscribeListener(EventType $eventType, Listener $listener): void
    {
        if (!$this->isListenerExistsAlreadyInQueue($listener, $eventType)) {
            $this->listeners[$eventType->getName()][] = $listener;
        }
    }

    public function notify(EventType $eventType, string $messageData): void
    {
        /** @var Listener $listener */
        foreach ($this->listeners[$eventType->getName()] as $listener) {
            $listener->update($messageData);
        }
    }

    private function isListenerExistsAlreadyInQueue(Listener $listener, EventType $eventType): bool
    {
        if (empty($this->listeners)) {
            return false;
        }

        if (
            is_array($this->listeners[$eventType->getName()])
            && array_key_exists($eventType->getName(), $this->listeners)
            && !empty($this->listeners[$eventType->getName()])
        ) {
            $isListenerSet = false;
            /** @var Listener $listener */
            foreach ($this->listeners[$eventType->getName()] as $listenerItem) {
                $isListenerSet = get_class($listenerItem) === get_class($listener);
            }
            return $isListenerSet;
        }


        return false;
    }
}

$em = new EventManager();
//$em->subscribeListener(new StoreDataInDbEvent(), new EmailAlertsListener());
$em->subscribeListener(new StoreDataInDbEvent(), new SmsAlertsListener());
$em->subscribeListener(new StoreDataInDbEvent(), new LoggingAlertsListener());
//$em->subscribeListener(new StoreDataInDbEvent(), new LoggingAlertsListener());

$em->subscribeListener(new FetchDataFromDbEvent(), new SmsAlertsListener());
$em->subscribeListener(new FetchDataFromDbEvent(), new LoggingAlertsListener());


$em->notify(new StoreDataInDbEvent(), 'zapisano cos do db ');

var_dump($em);
