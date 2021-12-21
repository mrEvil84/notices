<?php

// Pamiątka to behawioralny wzorzec projektowy pozwalający zapisywać i przywracać wcześniejszy stan obiektu bez ujawniania szczegółów jego implementacji.

interface Originator
{
    public function save(): Memento;
}

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

$apple1->save();
$caretaker->add($apple1->save());

$apple1->setName('lobo1');
$caretaker->add($apple1->save());


$apple1->setPrice(111.11);
$caretaker->add($apple1->save());

var_dump($caretaker->undo());
var_dump($caretaker->undo());
var_dump($caretaker->undo());