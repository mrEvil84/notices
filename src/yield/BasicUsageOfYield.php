<?php

// Internally, sequential integer keys will be paired with the yielded values, just as with a non-associative array.
function generator(): Generator
{
    for ($i=0; $i<3; $i++) {
        yield $i;
    }
}

$g = generator();


foreach ($g as $value) {
    var_dump($value);
}


$a = [1,2,3,4];
$id = array_shift($a);
var_dump($id);