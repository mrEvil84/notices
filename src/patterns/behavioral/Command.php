<?php

// Polecenie jest behawioralnym wzorcem projektowym,
// który zmienia żądanie w samodzielny obiekt zawierający wszystkie informacje o tym żądaniu.
// Taka transformacja pozwala na parametryzowanie metod przy użyciu różnych żądań.
// Oprócz tego umożliwia opóźnianie lub kolejkowanie wykonywania żądań oraz pozwala na cofanie operacji.

// Kiedy stosować:
// 1. Zastosuj wzorzec Polecenie gdy chcesz parametryzować obiekty za pomocą działań.
// 2. Wzorzec Polecenie pozwala układać kolejki zadań, ustalać harmonogram ich wykonania bądź uruchamiać je zdalnie.
// 3. Stosuj wzorzec Polecenie gdy, chcesz zaimplementować operacje odwracalne.

// Zalety:
// 1. Zasada pojedynczej odpowiedzialności. Można rozprzęgnąć klasy wywołujące polecenia od klas faktycznie je wykonujących.
// 2. Zasada otwarte/zamknięte. Można wprowadzić nowe polecenia do aplikacji bez psucia istniejącego kodu klienta.
// Pozwala zaimplementować cofnij/ponów.
// Pozwala zaimplementować opóźnione wykonywanie działań.
// Można złożyć zestaw prostszych poleceń w jedno skomplikowane.


interface Command
{
    public function execute(string $params): void;
}

class Button implements Command
{
    private Command $command;

    public function setCommand(Command $command): void
    {
        $this->command = $command;
    }

    public function execute(string $params): void
    {
       $this->command->execute($params);
    }
}

class SaveService
{
    private string $fakeDb;

    public function __construct(string $fakeDb)
    {
        $this->fakeDb = $fakeDb;
    }

    public function save(string $data): void
    {
        echo '[' . $this->fakeDb . ']' . ' save ' . $data . PHP_EOL;
    }
}

class SaveCommand implements Command
{
    private SaveService $saveService;

    public function __construct(SaveService $saveService)
    {
        $this->saveService = $saveService;
    }

    public function execute(string $params): void
    {
        echo '[Save command] : ' . PHP_EOL;
        $this->saveService->save($params);
    }
}

class OpenFileCommand implements Command
{
    public function execute(string $params): void
    {
        echo '[Open command] : ' . $params . PHP_EOL;
    }
}

class PrintCommand implements Command
{
    public function execute(string $params): void
    {
        echo '[Print command] : ' . $params . PHP_EOL;
    }
}

$button = new Button();
$button->setCommand(new OpenFileCommand());
$button->execute('C:\\path\\file.txt');
$button->setCommand(new SaveCommand(new SaveService('mysql')));
$button->execute('*** some string ***');
$button->setCommand(new PrintCommand());
$button->execute('data to print');

