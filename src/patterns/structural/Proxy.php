<?php

// MT: robienie rzeczy przez posrednika np. kontrolowanie dostepu do bazy danych
// (!!)
// MT: Proxy ma ten sam interfejs co db aby mozna je bylo wymiennie stosowac tak aby usluga nie wiedziala czy ma do czynienia z proxy czy obiektem db
// (!!)


// Pełnomocnik to strukturalny wzorzec projektowy pozwalający stworzyć obiekt zastępczy w miejsce innego obiektu.
// Pełnomocnik nadzoruje dostęp do pierwotnego obiektu, pozwalając na wykonanie jakiejś czynności przed
// lub po przekazaniu do niego żądania.
//
// Interfejs Usługi deklaruje interfejs z którym Pełnomocnik musi być zgodny, aby móc udawać obiekt usługi.
// np: Klient <-> Pośrednik <-> Baza danych

// Kiedy stosować :
//
// 1.  Leniwa inicjalizacja (wirtualny pełnomocnik).
// Gdy masz do czynienia z zasobożernym obiektem usługi, którego potrzebujesz jedynie co jakiś czas.
// 2. Kontrola dostępu (pełnomocnik ochronny). Przydatne, gdy chcesz pozwolić tylko niektórym klientom na korzystanie z obiektu usługi. Na przykład, gdy usługi stanowią kluczową część systemu operacyjnego, a klienci to różne uruchamiane aplikacje (również te szkodliwe).
// 3. Lokalne uruchamianie zdalnej usługi (pełnomocnik zdalny). Użyteczne, gdy obiekt udostępniający usługę znajduje się na zdalnym serwerze.
// 4. Prowadzenie dziennika żądań (pełnomocnik prowadzący dziennik). Pozwala prowadzić rejestr żądań przesyłanych do obiektu usługi.
// 5. Przechowywanie w pamięci podręcznej wyników działań (pełnomocnik z pamięcią podręczną). Pozwala przechować wyniki przekazywanych żądań i zarządzać cyklem życia pamięci podręcznej. Szczególnie ważne przy dużych wielkościach danych wynikowych.
// 6. Sprytne referencje. Można likwidować zasobożerny obiekt, gdy nie ma klientów którzy go potrzebują.

// Zalety:
// Można sterować obiektem usługi bez wiedzy klientów.
// Można zarządzać cyklem życia obiektu usługi, gdy klientów to nie interesuje.
// Pełnomocnik działa nawet wtedy, gdy obiekt udostępniający usługę nie jest jeszcze gotowy lub dostępny.
// Zasada otwarte/zamknięte. Można wprowadzać nowych pełnomocników do aplikacji bez modyfikowania usług lub klientów.

// Wady :
// Kod może ulec skomplikowaniu, ponieważ trzeba wprowadzić wiele nowych klas.
// Odpowiedzi ze strony usługi mogą ulec opóźnieniu.


interface DbWriter
{
    public function save(string $data): void;
    public function update(string $data): void;
}

class MySqlDbService implements DbWriter
{
    public function save(string $data): void
    {
        echo '** Write to db ' . $data . PHP_EOL;
    }

    public function update(string $data): void
    {
        echo '** Update to db' . $data . PHP_EOL;
    }
}

class DbServiceProxy implements DbWriter
{
    private DbWriter $mySqlDbService;

    public function __construct(DbWriter $mySqlDbService)
    {
        $this->mySqlDbService = $mySqlDbService;
    }

    public function save(string $data): void
    {
        echo '* Check if client have access to write' . PHP_EOL;
        echo '* Proxy validate and clear data before save' . PHP_EOL;
        $this->mySqlDbService->save($data);
        echo '* Notify others about data save.' . PHP_EOL;
    }

    public function update(string $data): void
    {
        echo 'Proxy validate and clear data before update' . PHP_EOL;
        $this->mySqlDbService->update($data);
        echo 'Notify others about data update.' . PHP_EOL;
    }
}

class DbClient
{
    private DbWriter $writer; // service and proxy

    public function __construct(DbWriter $writerServide)
    {
        $this->writer = $writerServide;
    }

    public function write(string $data): void
    {
        $this->writer->save($data);
    }

    public function update(string $data): void
    {
        $this->writer->update($data);
    }
}

$client1 = new DbClient(new MySqlDbService());
$client2 = new DbClient(new DbServiceProxy(new MySqlDbService()));

//$client1->write('some data');
$client2->write('some data');
