<?php

namespace PkowerzMacwro\GitSandbox\spl\datastructures;

use SplObserver;
use SplSubject;

class SplObjectStorageSandbox
{

}

// implementation of Obeserver pattern
class NewspaperPublisher implements \SplSubject
{
    private string $name;
    private \SplObjectStorage $observers;
    private string $actualNews;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->observers = new \SplObjectStorage();
    }

    public function breakOutNews(string $news): void
    {
        $this->actualNews = '[' . $this->name . ']' . $news;
        $this->notify();
    }

    public function getBreakingNews(): string
    {
        return $this->actualNews;
    }

    public function attach(SplObserver $observer)
    {
        var_dump($this->observers->contains($observer));

        if (!$this->observers->contains($observer)) {
            $this->observers->attach($observer);
        }
    }

    public function detach(SplObserver $observer)
    {
        $this->observers->detach($observer);
    }

    public function notify()
    {
        /** @var SplObserver $observer */
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}

class NewspaperSubsciber implements \SplObserver
{
    private string $readerName;

    public function __construct(string $readerName)
    {
        $this->readerName = $readerName;
    }

    /**
     * @param NewspaperPublisher $subject
     */
    public function update(SplSubject $subject)
    {
        echo '[ ' . $this->readerName . ' ] Read this: ' . $subject->getBreakingNews() . PHP_EOL;
    }
}

$subscriber1 = new NewspaperSubsciber('John');
$subscriber2 = new NewspaperSubsciber('Elsa');
$subscriber3 = new NewspaperSubsciber('Rebeca');

$newspaper = new NewspaperPublisher('Fr.Beobachter');
$newspaper->attach($subscriber1);
$newspaper->attach($subscriber1);
$newspaper->attach($subscriber2);
$newspaper->attach($subscriber3);

$newspaper->breakOutNews('***  The geo status ***');
$newspaper->breakOutNews('*** Trip advisor  ***');


