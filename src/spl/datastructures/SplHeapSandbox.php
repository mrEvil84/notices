<?php

namespace PkowerzMacwro\GitSandbox\spl\datastructures;

// stack - linear data structure
// cheap - can be eg. tree datastructure


class SplHeapSandbox
{

}

echo 'min: ' . PHP_EOL;

// keeping the minimum on the top
$h = new \SplMinHeap();

$h->insert([222,22]);
$h->insert([2,22]);
$h->insert([1,2332]);
$h->insert([1,2]);
$h->insert([43,22]);

/** @var array $item */
foreach ($h as $item) {
    var_dump($item);
}

echo 'max: ' . PHP_EOL;

$m = new \SplMaxHeap();


$m->insert([222,22]);
$m->insert([2,22]);
$m->insert([1,2332]);
$m->insert([1,2]);
$m->insert([43,22]);

/** @var array $item */
foreach ($m as $item) {
    var_dump($item);
}

