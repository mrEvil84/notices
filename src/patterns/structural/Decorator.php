<?php
// MT: pakowanie klasy final w obiekt (dekorator) aby ją sobie rozszerzyć bez psucia jej


// Dekorator to strukturalny wzorzec projektowy pozwalający dodawać nowe obowiązki obiektom poprzez umieszczanie tych obiektów
// w specjalnych obiektach opakowujących, które zawierają odpowiednie zachowania.

// Kiedy stosować :
//  1. Stosuj wzorzec Dekorator gdy chcesz przypisywać dodatkowe obowiązki obiektom w trakcie działania programu, bez psucia kodu, który z tych obiektów korzysta.
//  2. Stosuj ten wzorzec gdy rozszerzenie zakresu obowiązków obiektu za pomocą dziedziczenia byłoby niepraktyczne, lub niemożliwe.
//  3. Wiele języków programowania posiada słowo kluczowe final, za pomocą którego uniemożliwia się dalsze rozszerzanie klasy.
//     W przypadku klasy finalnej, jedynym sposobem na ponowne wykorzystanie istniejącego zachowania
//     jest opakowanie jej nakładkami swojego autorstwa — zgodnie ze wzorcem Dekorator, zachowane SRP, OCP

//  Zalety:
//  1. Można rozszerzać zachowanie obiektu bez tworzenia podklasy.
//  2. Można dodawać lub usuwać obowiązki obiektu w trakcie działania programu.
//  3. Możliwe jest łączenie wielu zachowań poprzez nałożenie wielu dekoratorów na obiekt.
//  4. Zasada pojedynczej odpowiedzialności. Można podzielić klasę monolityczną, która implementuje wiele wariantów zachowań, na mniejsze klasy.
//
//  Wady:
//  1.  Zabranie jednej konkretnej nakładki ze środka stosu nakładek jest trudne.
//  2.  Trudno jest zaimplementować dekorator w taki sposób, aby jego zachowanie nie zależało od kolejności ułożenia nakładek na stosie.
//

class SmsNotifier implements Component
{
    public function send(string $message): void
    {
        echo 'Sms send : ' . $message . PHP_EOL;
    }
}

class FacebookNotifier implements Component
{
    public function send(string $message): void
    {
        echo 'Facebook send: ' . $message . PHP_EOL;
    }
}

class MessengerNotifier implements Component
{
    public function send(string $message): void
    {
        echo 'Messenger send: ' . $message . PHP_EOL;
    }
}

interface Component
{
    public function send(string $message): void;
}

abstract class BaseDecorator implements Component
{
    protected Component $wrapee;

    public function __construct(Component $component)
    {
        $this->wrapee = $component;
    }

    abstract public function send(string $message): void;
}

class FacebookNotifierDecorator extends BaseDecorator
{
    public function __construct(Component $component)
    {
        parent::__construct($component);
    }

    public function send(string $message): void
    {
        echo ' [ FacebookNotifierDecorator : ' . PHP_EOL;
        $this->wrapee->send($message);
        echo ' ] ' . PHP_EOL;
    }
}

class MessengerNotifierDecorator extends BaseDecorator
{
    public function __construct(Component $component)
    {
        parent::__construct($component);
    }


    public function send(string $message): void
    {
        echo '[ MessengerNotifierDecorator ' . PHP_EOL;
        $this->wrapee->send($message);
        echo ' ] ' . PHP_EOL;
    }
}

class ClientNotifier
{
    private array $notifiers;

    public function add(Component $notifier)
    {
        $this->notifiers [] = $notifier;
    }

    public function send(string $message): void
    {
        if (!empty($this->notifiers)) {
            /** @var Component $notifier */
            foreach ($this->notifiers as $notifier) {
                $notifier->send($message);
            }
        }
    }

}

$fb = new FacebookNotifierDecorator(new FacebookNotifier());
$mssng = new MessengerNotifier();
$mssng2 = new MessengerNotifierDecorator(new MessengerNotifier());
$sms = new SmsNotifier();

$client = new ClientNotifier();
$client->add($fb);
$client->add($mssng);
$client->add($mssng2);
$client->add($sms);

$client->send('*** Awesome message ***');
