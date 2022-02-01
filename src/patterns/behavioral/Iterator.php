<?php

// Iterator to behawioralny wzorzec projektowy, pozwalający sekwencyjnie przechodzić od elementu do elementu
// jakiegoś zbioru bez konieczności eksponowania jego formy (lista, stos, drzewo, itp.).

// Idea iteratora to przetwarzanie kolekcji, list, drzew , etc. delegując sposób przechodzenia po strukturze dla klasy
// która, daną strukturę wykorzystuje do przechowywania danych w kolekcjach

//Oprócz implementowania samego algorytmu,
// obiekt iteratora hermetyzuje wszystkie szczegóły sposobu przechodzenia przez kolejne elementy,
// jak bieżąca pozycja, czy ilość pozostałych elementów.
// Dzięki temu wiele iteratorów może jednocześnie przeglądać tę samą kolekcję, niezależnie od siebie.

// Kiedy stosować:

// 1.  Stosuj wzorzec Iterator gdy kolekcja z którą masz do czynienia posiada skomplikowaną strukturę,
//     ale zależy ci na ukryciu jej przed klientem (dla wygody, lub dla bezpieczeństwa).
// 2.  Stosuj Iterator gdy chcesz, aby twój kod był w stanie przeglądać elementy różnych struktur danych,
//      lub gdy nie znasz z góry szczegółów ich struktury.

// Zalety
// 1. SRP Zasada pojedynczej odpowiedzialności. Można uprzątnąć kod klienta i kolekcje, ekstrahując obszerny kod przeglądania do osobnych klas.
// 2. OCP Zasada otwarte/zamknięte. Można zaimplementować nowe typy kolekcji i iteratorów oraz przekazywać je do istniejącego kodu bez psucia czegokolwiek.
// 3. Można przeglądać tę samą kolekcję równolegle wieloma iteratorami, gdyż każdy z nich przechowuje informacje o swoim stanie.
// 4. Z powyższego powodu można opóźniać iterację i kontynuować ją gdy zachodzi taka potrzeba.

// Wady:
// 1. Zastosowanie tego wzorca będzie przesadą jeśli twoja aplikacja korzysta wyłącznie z prostych kolekcji.
// 2. Używanie iteratora może być mniej efektywne niż bezpośrednie przejście po elementach jakiejś wyspecjalizowanej kolekcji.

// revind , next valid

class Pikej
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return 'Pikej id = ' . $this->id;
    }

}

class PikejConcreteIterator implements \Iterator
{
    private PikejCollection $collection;
    private int $position = 0;

    public function __construct(PikejCollection $collection)
    {
        $this->collection = $collection;
    }


    public function current(): Pikej
    {
        return $this->collection->getCollection()[$this->position];
    }

    // This is the first method called when starting a foreach loop. It will not be executed after foreach loops.
    public function rewind(): void
    {
        $this->position = 0;
    }

    // Moves the current position to the next element. (!)
    // This method is called after each foreach loop.
    public function next(): void
    {
        ++$this->position;
    }

    // This method is called after Iterator::rewind() and Iterator::next() to check if the current position is valid.
    public function valid(): bool
    {
        return isset($this->collection->getCollection()[$this->position]);
    }

    public function key(): int
    {
        return $this->position;
    }
}


class PikejCollection
{
    private array $collection;

    public function __construct(Pikej ...$collection)
    {
        $this->collection = $collection;
    }

    public function getIterator(): Iterator
    {
        return new PikejConcreteIterator($this);
    }

    public function getCollection(): array
    {
        return $this->collection;
    }
}

$pikejCollection = new PikejCollection(
    ...[
        new Pikej(1),
        new Pikej(2),
        new Pikej(3),
        new Pikej(4),
        new Pikej(5),
    ]
);

$pikejIterator = $pikejCollection->getIterator();

//while ($pikejIterator->valid()) {
//    echo  $pikejIterator->current() . PHP_EOL;
//    $pikejIterator->next();
//}


/** @var Pikej $element */
foreach ($pikejIterator as $element) {
   echo $element . PHP_EOL;
}

$data = new ArrayIterator($pikejCollection->getCollection());
$data->append(new Pikej(6));
$data->uasort(fn(Pikej $pikej) => $pikej->getId());

/** @var Pikej $pikej */
foreach ($data as $pikej) {
    echo $pikej . PHP_EOL;
}

// keyed collection pikej
$pikejKeyed = [
    'a' => new Pikej(1),
    'd' => new Pikej(2),
    'V' => new Pikej(10),
    'G' => new Pikej(4),
    'b' => new Pikej(5),
];

$data2 = new ArrayIterator($pikejKeyed);

//$data2->uksort(fn($a,$b) => $a <=> $b); // sortowanie po kluczu
$data2->natsort();

/**
 * @var string $key
* @var Pikej $pikej */
foreach ($data2 as $key => $pikej) {
    echo $key . ' ' . $pikej . PHP_EOL;
}