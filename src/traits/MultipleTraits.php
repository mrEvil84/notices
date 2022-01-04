<?php

trait Filter
{
    public function filterByString(): void
    {
        echo 'Filter by string' . PHP_EOL;
    }
}

trait Sort
{
    public function sortNumber(): void
    {
        echo 'Sort number' . PHP_EOL;
    }
}

class PersonList
{
    use Filter, Sort;
}

$personList = new PersonList();
$personList->filterByString();
$personList->sortNumber();