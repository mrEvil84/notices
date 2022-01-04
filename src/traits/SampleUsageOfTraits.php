<?php

// traity mozna rozumiec jak interfejsy z implementacja

class Person
{
    use SayWords;

    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}

trait SayWords
{
    public function sayHello(string $name): void
    {
        echo 'Hello ' . $name . PHP_EOL;
    }

    public function showSelf(): void
    {
        var_dump($this->getName());
        var_dump($this);
    }
}




$person = new Person('Piotreks');

$person->sayHello('Piotrek');
$person->showSelf();