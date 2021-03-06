<?php

$languages = ['Ruby', 'PHP', 'C++', 'Java'];

array_walk($languages, static function (&$v, $k) {
    // v - item value
    // k - current loop number

    $v = $v .= ' -programming language';
    //echo $k . PHP_EOL;
});

print_r($languages);

$digits = [1,2,3,4,5,6];
$exponent = 2;

$myFunc = function (&$v) use ($exponent) {
    $v = pow($v, $exponent);
};

array_walk($digits, $myFunc);
print_r($digits);

// arrow functions since 7.4

$myFunc2 = fn(&$v, $exponent)  => $v = pow($v, $exponent);

array_walk($digits, $myFunc2);
print_r($digits);

class Person
{
    private string $name;
    private string $surname;
    private int $age;

    public function __construct(string $name, string $surname, int $age)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->age = $age;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getAge(): int
    {
        return $this->age;
    }
}

$persons = [
    new Person('Jan', 'Kos', 18),
    new Person('Albert', 'Kowalski', 18),
    new Person('Czesław', 'Niemen', 18),
];

function sortByName(array $persons): array
{
    usort(
        $persons,
        static function (Person $p, Person $q) {
            return $p->getName() <=> $q->getName();
        }
    );
    return $persons;
}

var_dump(
    sortByName($persons)
);
