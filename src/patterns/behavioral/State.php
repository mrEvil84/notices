<?php


// MT: wzorzec stan przechowuje stan obiektu w danej chwili, np. stan dokumentu w stanie Draft

// Kiedy stosowac

// 1. Stosuj wzorzec Stan gdy masz do czynienia z obiektem, którego zachowanie jest zależne od jego stanu,
// liczba możliwych stanów jest wielka, a kod specyficzny dla danego stanu często ulega zmianom.

// 2. Stosuj ten wzorzec gdy masz klasę zaśmieconą rozbudowanymi instrukcjami warunkowymi zmieniającymi
// zachowanie klasy zależnie od wartości jej pól.

// 3. Wzorzec Stan pomaga poradzić sobie z dużą ilością kodu który się powtarza w wielu stanach i przejściach
//  między stanami automatu skończonego, bazującego na instrukcjach warunkowych.

// Zalety:
// 1. Zasada pojedynczej odpowiedzialności. Zorganizuj kod związany z konkretnymi stanami w osobne klasy.
// 2. Zasada otwarte/zamknięte. Można wprowadzać nowe stany bez zmiany istniejących klas stanu lub kontekstu.
// 3. Upraszcza kod kontekstu eliminując obszerne instrukcje warunkowe automatu skończonego.

// Wady:
// 1. Zastosowanie tego wzorca może być przesadą jeśli mamy do czynienia zaledwie z kilkoma stanami i rzadkimi zmianami.



abstract class State
{
    protected string $documentState;

    public function setDocumentState(string $documentState): void
    {
        $this->documentState = $documentState;
    }

    abstract public function render(): void;

    abstract public function publish(): void;
}

class Draft extends State
{
    public function render(): void
    {
        echo '[Info] : Document is in draft state' . PHP_EOL;
        echo '[Info] : Classified data can\'t be displayed' . PHP_EOL;
    }

    public function publish(): void
    {
        echo '[Info] : Can\'t publish document while in draft version' . PHP_EOL;
    }
}

class ReadyToPublish extends State
{
    public function render(): void
    {
        echo '[Info] : Document is ready to publish' . PHP_EOL;
        echo '[Info] : data to be rendered: ' . $this->documentState . PHP_EOL;
    }

    public function publish(): void
    {
        echo 'Published document: (...) ' . PHP_EOL;
    }
}

class Document
{
    private string $data = '';
    private State $state;

    public function __construct(State $state)
    {
        $state->setDocumentState($this->data);
        $this->setState($state);
    }

    public function appendData(string $data): void
    {
        $this->data .= $data;
    }

    public function setState(State $state)
    {
        unset($this->state);
        $state->setDocumentState($this->data);
        $this->state = $state;
    }

    public function getCurrentState(): State
    {
        return $this->state;
    }

    public function changeState(State $state): void
    {
        $this->state = $state;
    }

    public function render(): void
    {
        if (!$this->state instanceof ReadyToPublish) {
            $this->state->render();
            echo '[Error] : incorrect state to render doc.' . PHP_EOL;
        } else {
            echo $this->data . PHP_EOL;
        }
    }

    public function publish(): void
    {
        if (!$this->state instanceof ReadyToPublish) {
            echo '[Error] : incorrect state to publish doc.' . PHP_EOL;
        } else {
            echo $this->data . PHP_EOL;
        }
    }
}

$statesHistory = [];

$doc = new Document(new Draft());
$doc->appendData('Tajne dane w dokumencie.');
$doc->render();
$doc->publish();

$statesHistory[] = $doc->getCurrentState();

$ready = new ReadyToPublish();
$doc->setState($ready);
$doc->render();
$doc->publish();
$statesHistory[] = $doc->getCurrentState();

var_dump($statesHistory);



//$ready = new ReadyToPublish($doc);
//$doc->setState($ready);
//$doc->publish();

//$ready = new ReadyToPublish($doc);
//$doc->setState($ready);
//$doc->publish();



