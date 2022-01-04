<?php


$a = 1;
$b = 2;
echo $a <=> $b . PHP_EOL; // -1

$a = 2;
echo $a <=> $b . PHP_EOL; // 0

$a = 3;
echo $a <=> $b . PHP_EOL; // 1


// Standardowe użycie usort()
$a = [1,4,7,3,2,6,7];
usort($a, function($a, $b){
    if ($a == $b) {
        return 0;
    }
    return ($a < $b) ? -1 : 1;
});

// Spaceship operator
$a = [1,4,7,3,2,6,7];
usort($a, function($a, $b){
    echo $a . '-' . $b . PHP_EOL;
    return $a <=> $b;
});

var_dump($a);