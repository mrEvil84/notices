<?php


// MT: do zachowywania stanu obiektow i tworzenia z niej historii stanow obiektu
// MT: dwa interfejsy Oiriginator i Memento , originator zwraca memento , originator-save:memento , memento-restore:originator/object

// Pamiątka to behawioralny wzorzec projektowy pozwalający zapisywać i przywracać wcześniejszy stan obiektu bez ujawniania szczegółów jego implementacji.

// Kiedy stosować:
// 1. Stosuj wzorzec Pamiątka gdy chcesz tworzyć migawki stanu obiektu i móc przywracać poprzedni jego stan.
// 2. Stosuj ten wzorzec gdy, bezpośredni dostęp do pól/getterów/setterów obiektu psuje hermetyzację.

// Zalety:
//  1. Można tworzyć migawki stanu obiektów bez naruszania ich hermetyzacji.
//  2. Można uprościć kod źródła, pozwalając zarządcy śledzić historię stanu źródła.

// Wady:
// 1. Aplikacja może wymagać dużej ilości pamięci RAM jeśli klienci zbyt często będą tworzyć pamiątki.
// 2. Zarządcy powinni śledzić cykl życia źródła, aby być w stanie kasować zbędne pamiątki.
// 3. Większość dynamicznych języków programowania, jak PHP, Python i JavaScript nie daje gwarancji niezmienialności stanu pamiątki.

interface Memento
{
    public function restore(): object;
}

class Apple implements Originator
{
    private string $name;
    private float $price;

    public function __construct(string $name, float $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function save(): Memento
    {
        return new AppleMemento($this);
    }
}

class AppleMemento implements Memento
{
    private Apple $originator;
    private array $state;
    private string $creationDate;

    public function __construct(Apple $originator)
    {
        $this->originator = $originator;
        $this->state = ['name' => $originator->getName(), 'price' => $originator->getPrice()];
        $this->creationDate = date('Y-m-d H:i:s');
    }

    public function restore(): Apple
    {
        echo 'Restore Apple : State: name: ' . $this->state['name'] . ' price: ' . $this->state['price'] . 'creation date: ' . $this->creationDate . PHP_EOL;
        $this->originator->setPrice($this->state['price']);
        $this->originator->setName($this->state['name']);
        return $this->originator;
    }
}

class Caretaker
{
    /**
     * @var Memento[]
     */
    private array $history;

    public function add(Memento $memento) {
        $this->history [] = $memento;
    }

    public function undo(): Originator
    {
        /** @var AppleMemento $appleMemento */
        $appleMemento = array_pop($this->history);

       return $appleMemento->restore();
    }
}

$caretaker = new Caretaker();

$apple1 = new Apple('lobo', 10.50);
$caretaker->add($apple1->save());

$apple1->setName('lobo1');
$caretaker->add($apple1->save());


$apple1->setPrice(111.11);
$caretaker->add($apple1->save());

var_dump($caretaker);
//var_dump($caretaker->undo());
//var_dump($caretaker->undo());
//var_dump($caretaker->undo());