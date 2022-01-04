<?php

declare(strict_types=1);

// MT: Pilot i sterowanie telewizorem,  interfejs z funkcjami to pilot a klasa to logika realizujaca sterowanie z pilota. -> tv

// Most jest strukturalnym wzorcem projektowym pozwalającym na rozdzielenie dużej klasy
// lub zestawu spokrewnionych klas na dwie hierarchie — abstrakcję oraz implementację.
// Nad obiema można wówczas pracować niezależnie.
// Przykład pilota do telewizora

// Kiedy stosowac ?
//
// 1. Stosuj wzorzec Most gdy chcesz rozdzielić i przeorganizować monolityczną klasę posiadającą wiele wariantów takiej samej funkcjonalności (na przykład, jeśli klasa ma współpracować z wieloma serwerami bazodanowymi).
// 2. Użyj tego wzorca gdy chcesz rozszerzyć klasę na kilku niezależnych płaszczyznach.
// 3. Most pozwala spełnić wymóg możliwości wyboru implementacji w trakcie działania programu.

// Zalety:
//
// 1. Możesz tworzyć niezależne od platformy klasy i aplikacje.
// 2. Kod klienta działa na wyższym poziomie abstrakcji. Nie musi mieć do czynienia ze szczegółami platformy.
// 3. Zasada otwarte/zamknięte. Możesz wprowadzać nowe abstrakcje i implementacje niezależnie od siebie.
// 4.  Zasada pojedynczej odpowiedzialności. W abstrakcji możesz skupić się na wysokopoziomowej logice, zaś w implementacji na szczegółach platformy.

// Wady
//
// 1. Kod może stać się bardziej skomplikowany gdy zastosuje się ten wzorzec w przypadku wysoce zwartej klasy.


//Most zazwyczaj wykorzystuje się od początku projektu, by pozwolić na niezależną pracę nad poszczególnymi częściami aplikacji.
// Z drugiej strony, Adapter jest rozwiązaniem stosowanym w istniejącej aplikacji w celu umożliwienia współpracy pomiędzy niekompatybilnymi klasami.
//
//Most, Stan, Strategia (i w pewnym stopniu Adapter) mają podobną strukturę.
// Wszystkie oparte są na kompozycji, co oznacza delegowanie zadań innym obiektom.
// Jednak każdy z tych wzorców rozwiązuje inne problemy.
// Wzorzec nie jest bowiem tylko receptą na ustrukturyzowanie kodu w pewien sposób, lecz także informacją dla innych deweloperów o charakterze rozwiązywanego problemu.
//
//Fabryka abstrakcyjna może być stosowana wraz z Mostem.
// Takie sparowanie jest użyteczne gdy niektóre abstrakcje zdefiniowane przez Most mogą współdziałać wyłącznie z określonymi implementacjami.
// W tym przypadku, Fabryka abstrakcyjna może hermetyzować te relacje i ukryć zawiłości przed kodem klienckim.
//
//Możliwe jest połączenie wzorców Budowniczy i Most: klasa kierownik pełni rolę abstrakcji, zaś poszczególni budowniczy stanowią implementacje.





// interfejs def. urzadzenia , ktore sa sterowane przez pilota
interface Device
{
    public function getName(): string;
    public function isEnabled(): bool;
    public function enable(): void;
    public function disable(): void;
    public function getVolume(): int;
    public function setVolume(int $percent): void;
    public function getChannel():int;
    public function setChannel(int $number): void;
}

class Tv implements Device
{
    private $isEnabled = false;
    private int $volume = 0;
    private int $channel = 0;

    public function getName(): string
    {
        return 'TV';
    }

    public function isEnabled(): bool
    {
        return $this->isEnabled;
    }

    public function enable(): void
    {
        $this->isEnabled = true;
        echo 'tv is enabled' . PHP_EOL;
    }

    public function disable(): void
    {
        $this->isEnabled = false;
        echo 'tv is disabled' . PHP_EOL;
    }

    public function getVolume(): int
    {
        return $this->volume;
    }

    public function setVolume(int $percent): void
    {
        $this->volume = $percent;
        echo 'Actual volume is : '  . $this->volume . ' [%]' . PHP_EOL;
    }

    public function getChannel(): int
    {
        return $this->channel;
    }

    public function setChannel(int $number): void
    {
        $this->channel = $number;
        echo 'Actual channel ' . $this->channel . PHP_EOL;
    }
}

// klasa stanowiaca abstrakcje, pilot moze byc do roznych urzadzen
class Remote
{
    private Device $device;
    private int $volume = 0;
    private int $channel = 0;

    public function __construct(Device $device)
    {
        $this->device = $device;
    }

    public function togglePower(): void
    {
        if (!$this->device->isEnabled()) {
            $this->device->enable();
        } else {
            $this->device->disable();
        }
    }

    public function volumeUp(): void
    {
        $volume = $this->device->getVolume();
        $this->setVolume(++$volume);
    }

    public function volumeDown(): void
    {
        $volume = $this->device->getVolume();
        $this->setVolume(--$volume);
    }

    private function setVolume(int $volume): void
    {
        if ($volume >=0 && $volume <= 100) {
            $this->device->setVolume($volume);
        }
    }

    private function setChannel(int $channel): void
    {
        if ($channel > 0) {
            $this->device->setChannel($channel);
        }
    }

    public function channelUp(): void
    {
        $channel = $this->device->getChannel();
        $this->setChannel(++$channel);
    }

    public function channelDown(): void
    {
        $channel = $this->device->getChannel();
        $this->setChannel(--$channel);
    }
}

$tvRemote = new Remote(new Tv());

$tvRemote->togglePower();
$tvRemote->volumeUp();
$tvRemote->volumeUp();
$tvRemote->volumeUp();
$tvRemote->channelUp();
$tvRemote->channelUp();
$tvRemote->channelUp();
$tvRemote->togglePower();