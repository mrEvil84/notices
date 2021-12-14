<?php

// fabryka abstrakcyjna pozwala tworzyć rodziny spokrewnionych ze sobą obiektow bez okreslania konkretnych klas
// np. fabryka mebli, -> fabrykka krzeseł -> (krzesło art-deco, krzesło wiktoriańskie, krzesło nowoczesne itd.)



interface Chair // this is abstract factory
{
    public function create(): void;
    public function getName(): string;
    public function hasLegs(): bool;
}

class VictorianChair implements Chair
{
    private string $name;

    public function create(): void
    {
        $this->name = 'VictorianChair';
        // TODO: Implement create() method.
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function hasLegs(): bool
    {
        return true;
    }
}