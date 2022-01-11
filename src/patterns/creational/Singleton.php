<?php

// Singleton jest kreacyjnym wzorcem projektowym,
// który pozwala zapewnić istnienie wyłącznie jednej instancji danej klasy.
// Ponadto daje globalny punkt dostępowy do tejże instancji.
// Wzorzec Singleton rozwiązuje jednocześnie dwa problemy, ale jednocześnie łamie Zasadę pojedynczej odpowiedzialności:
// Zapewnia istnienie wyłącznie jednej instancji danej klasy.
// Pozwala na dostęp do tej instancji w przestrzeni globalnej.

// Kiedy stosowac :
// 1. Korzystaj z wzorca Singleton, gdy w twoim programie ma prawo istnieć wyłącznie jeden ogólnodostępny
// obiekt danej klasy. Przykładem może być połączenie z bazą danych, którego używa wiele fragmentów programu.
// 2. Stosuj wzorzec Singleton gdy potrzebujesz ściślejszej kontroli nad zmiennymi globalnymi.


// Zalety:
// 1. Masz pewność, że istnieje tylko jedna instancja klasy.
// 2. Zyskujesz globalny dostęp do tej instancji.
// 3. Obiekt singleton inicjalizowany jest dopiero wtedy, gdy jest po raz pierwszy potrzebny.

// Wady:
// 1. Łamie Zasadę pojedynczej odpowiedzialności. Wzorzec rozwiązuje bowiem dwa różne problemy jednocześnie.
// 2. Zastosowanie wzorca Singleton może zamaskować niewłaściwe projektowanie. Można na przykład doprowadzić do sytuacji, w której komponenty programu wiedzą zbyt wiele o sobie nawzajem.
// 3. Wzorzec ten wymaga specjalnej uwagi w środowisku wielowątkowym, w którym trzeba unikać tworzenia wielu instancji singletona przez wiele wątków.
// 4. Utrudnieniu mogą ulec testy jednostkowe kodu klienckiego klasy singleton,
// ponieważ wiele frameworków testujących polega na dziedziczeniu przy produkcji atrap obiektów. Ponieważ konstruktor klasy Singleton jest prywatny, a nadpisywanie statycznych metod jest niemożliwe w większości języków programowania, będzie trzeba wykazać się kreatywnością i znaleźć jakiś inny sposób tworzenia atrapy singletona. Albo nie pisać testów, albo zrezygnować z tego wzorca.

class Connection
{
    private ?Connection $connection = null;

    private function __construct()
    {
    }

    public function getConnection(): self
    {
        if ($this->connection === null) {
            $this->connection = new self();

        }
        return $this->connection;
    }

    private function __clone()
    {
    }

    public function __invoke()
    {
    }
}

