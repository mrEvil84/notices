<?php


// MT: wzorzec stan przechowuje stan obiektu w danej chwili, np. stan dokumentu w stanie Draft

abstract class State
{
    protected Document $document;

    public function setDocument(Document $document): void
    {

        $this->document = clone $document;
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
        echo '[Info] : data to be rendered: ' . $this->document->render() . PHP_EOL;
    }

    public function publish(): void
    {
        echo 'Published document: (...) ' . PHP_EOL;
    }
}

class Document
{
    private State $state;
    private string $data;

    public function __construct(State $state)
    {
        $this->setState($state);
    }

    public function appendData(string $data): void
    {
        $this->data .= $data;
    }

    public function setState(State $state)
    {
        unset($this->state);
        $this->state = $state;
        $this->state->setDocument($this);
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



