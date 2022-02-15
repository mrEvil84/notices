<?php

namespace PkowerzMacwro\GitSandbox\spl\datastructures;

use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;

class SplDoubleLinkedListSandbox
{
}

$list = new \SplDoublyLinkedList();
$list->push('a');
$list->push('b');
$list->push('c');
$list->push('d');

$list->setIteratorMode(\SplDoublyLinkedList::IT_MODE_LIFO);

/** @var string $letter */
foreach ($list as $letter) {
    echo $letter . PHP_EOL;
}

echo 'count = ' . $list->count() . PHP_EOL;

$list->setIteratorMode(\SplDoublyLinkedList::IT_MODE_FIFO);

/** @var string $letter */
foreach ($list as $letter) {
    echo $letter . PHP_EOL;
}

echo 'count = ' . $list->count() . PHP_EOL;

$stack = new \SplStack();
$stack->push(1);
$stack->push(2);
$stack->push(3);
$stack->push(4);
/** @var int $digit */

foreach ($stack as $digit) {
    echo $digit . PHP_EOL;
}

$stack->rewind();
while ($stack->valid()) {
    echo $stack->current() . PHP_EOL;
    $stack->next();
}
