<?php

//Łańcuch zobowiązań jest behawioralnym wzorcem projektowym,
// który pozwala przekazywać żądania wzdłuż łańcucha obiektów obsługujących.
// Otrzymawszy żądanie, każdy z obiektów obsługujących decyduje o przetworzeniu żądania lub przekazaniu
// go do kolejnego obiektu obsługującego w łańcuchu.

// dane na ktorych operuje wzorzec:
// uwaga na dane przekazywane przez obiekt, trzeba wpuszczac nowy obiekt jak chce się wykonać łańcuch zależności na danych
//
// Kiedy stosować :
//     1.  Stosuj wzorzec Łańcuch zobowiązań gdy, twój program ma obsługiwać różne rodzaje żądań na różne sposoby,
//         ale dokładne typy żądań i ich sekwencji nie są wcześniej znane
//     2.  Stosuj ten wzorzec gdy, istotne jest uruchomienie wielu obiektów obsługujących w pewnej kolejności.
//     3.  Łańcuch zobowiązań pozwala ustawić obiekty obsługujące i ich kolejność w czasie działania programu.

// Zalety:
//  1. mozna ustalac porzadek obslugi rzadania
//  2. zasada SRP (Signle Responsibility Principle) jest zachowana
//  3. Zadada OCP (Open Close Principle) jest zachowana

// Wady:
// 1. Niektóre żądania mogą wcale nie zostać obsłużone


class ChainRequest
{
    private string $data;

    public function __construct(string $data)
    {
        $this->data = $data;
    }

    public function getData(): string
    {
        return $this->data;
    }

    public function setData(string $data): void
    {
        $this->data = $data;
    }

    public function appendToData(string $data): void
    {
        $this->data .= $data;
    }
}

interface Handler
{
    public function setNext(Handler $handler): Handler;
    public function handle(ChainRequest $chainRequest): ?ChainRequest;
    public function getNextHandler(): ?Handler;
}

abstract class BaseHandler implements Handler
{
    private ?Handler $nextHandler = null;

    public function setNext(Handler $handler): Handler
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    public function handle(ChainRequest $chainRequest): ?ChainRequest
    {
        if ($this->nextHandler !== null) {
            echo '->base handler : next handler set ' . PHP_EOL;
            return $this->nextHandler->handle($chainRequest);
        } else {
            echo '->base handler : next handler not set, return data :' . PHP_EOL;
        }

        return $chainRequest;
    }

    public function getNextHandler(): ?Handler
    {
        return $this->nextHandler ?? null;
    }
}

class EncoderHandler extends BaseHandler
{
    public function handle(ChainRequest $chainRequest): ?ChainRequest
    {
        echo 'Log: EncoderHandler: md encode ...->' . PHP_EOL;
        $encodedData = md5($chainRequest->getData()) . '===' . $chainRequest->getData();
        echo ' ' . $encodedData . PHP_EOL;
        $chainRequest->setData($encodedData);

        return parent::handle($chainRequest);
    }
}

class DateTimeHandler extends BaseHandler
{
    public function handle(ChainRequest $chainRequest): ?ChainRequest
    {
        echo 'Log: DateTimeHandler: append date to data' . PHP_EOL;
        $chainRequest->appendToData('-added-at-' . time() . ' ' . date('Y-m-d H:i:s, l'));

        return parent::handle($chainRequest);
    }
}


class TextProcessor // client class
{
    private Handler $handler;

    public function __construct(Handler $handler)
    {
        $this->handler = $handler;
    }

    public function setHandler(Handler $handler): void
    {
        $this->handler = $handler;
    }

    public function processData(ChainRequest $data): ?ChainRequest
    {
        return $this->handler->handle($data);
    }
}

$requestData = new ChainRequest('Piotr Kowerzanow'); // request

$encoderHandler = new EncoderHandler();
$encoderHandler->setNext(new DateTimeHandler()); // ustawienie kolejnosci wykonań


$textProcessor = new TextProcessor($encoderHandler);
$processedData = $textProcessor->processData($requestData);

var_dump($processedData);
var_dump($requestData);

echo '---------'.PHP_EOL;
$textProcessor->setHandler(new DateTimeHandler());
$test2 = $textProcessor->processData(new ChainRequest('testetstststststs'));

var_dump($test2);


