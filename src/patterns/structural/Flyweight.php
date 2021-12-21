<?php

// Pyłek jest strukturalnym wzorcem projektowym pozwalającym zmieścić więcej obiektów w danej przestrzeni pamięci RAM poprzez współdzielenie części opisu ich stanów.


// klasa pyłka przechowujaca wewnetrzny stan obiektu wspolny dla grupy obiektow
class TreeTypeFlyweight
{
    private string $name;
    private string $color;
    private string $texture;

    public function __construct(string $name, string $color, string $texture)
    {
        $this->name = $name;
        $this->color = $color;
        $this->texture = $texture;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getTexture(): string
    {
        return $this->texture;
    }
}

class TreeTypeFactory
{
    private array $treeTypesFleiweight;

    public function getTreeTypeFleiweight(string $name, string $color, string $texture): TreeTypeFlyweight
    {
        $treeTypeFleiweight = new TreeTypeFlyweight($name, $color, $texture);
    }
}