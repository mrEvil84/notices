<?php

namespace PkowerzMacwro\GitSandbox\spl\datastructures;

// The main difference between a SplFixedArray and a normal PHP array is that the SplFixedArray must be resized manually
// The advantage is that it uses less memory than a standard array.

class SplFixedArraySandbox
{
}

$memUsage = memory_get_usage();


$data = new \SplFixedArray(10);
for ($i = 0; $i < 10; $i++) {
    $data[$i] = $i;
}

$memUsage2 = memory_get_usage();

echo 'SplFixedArray mem udage : ' . $memUsage2-$memUsage . PHP_EOL;

$m1 = memory_get_usage();
$data2 = [];

$data = new \SplFixedArray(10);
for ($i = 0; $i < 10; $i++) {
    $data2[$i] = $i;
}
$m2 = memory_get_usage();

echo 'Array mem usage : ' . $m2-$m1 . PHP_EOL;




