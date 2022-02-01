<?php

namespace PkowerzMacwro\GitSandbox\spl\datastructures;

class SplQueueSandbox
{

}

$queue = new \SplQueue();

$queue->push(1);
$queue->push(2);
$queue->push(3);

var_dump($queue);

$x = $queue->pop();

var_dump($x);


