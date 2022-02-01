<?php

namespace PkowerzMacwro\GitSandbox\spl\datastructures;

class SplPriorityQueueSandbox extends \SplPriorityQueue
{
    public function compare($prio1, $prio2)
    {
        return $prio1 <=> $prio2;
    }

}


$queue = new SplPriorityQueueSandbox();
$queue->insert('A', 3);
$queue->insert('B', 6);
$queue->insert('C', 1);
$queue->insert('D', 2);

echo 'count -> ' . $queue->count() . PHP_EOL;



var_dump($queue->top());


while ($queue->valid()) {
    echo $queue->current() . PHP_EOL;
    $queue->next();
}