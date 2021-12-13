<?php
declare(strict_types=1);

class Person {
    public string $name;
    public string $surname;
    public int $age;

    public function __construct(string $name, string $surname, int $age)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->age = $age;
    }
}

$person1 = new Person('Piotr', 'K', 38);
$person2 = new Person('Piotr', 'K', 38);
$person3 = new Person('Piotr', 'K', 38);
$person4 = new Person('Piotr', 'K', 40);
$person5 = new Person('Piotr', 'K', 12);
$person6 = new Person('Piotr', 'K', 10);

$persons = [
    $person1,
    $person2,
    $person3,
    $person4,
    $person5,
    $person6,
];

$comparator = static function (int $ageMax, string $surname) {
    return static function (Person $person) use ($ageMax, $surname) {
        return $person->age <= $ageMax && $person->surname === $surname;
    };
};

//$adults = array_filter($persons, $comparator(18, 'K'));
//var_dump($adults);

var_dump(array_column($persons, 'name')); // returns values of object field