<?php

$languages = ['Ruby', 'PHP', 'C++', 'Java'];

array_walk($languages, static function (&$v, $k) {
    // v - item value
    // k - current loop number

    $v = $v .= ' -programming language';
    echo $k . PHP_EOL;
});

print_r($languages);

$digits = [1,2,3,4,5,6];
$exponent = 2;

$myFunc = function (&$v) use ($exponent) {
   $v = pow($v, $exponent);
};

array_walk($digits, $myFunc);
print_r($digits);

// arrow functions since 7.4

$myFunc2 = fn(&$v, $exponent)  => $v = pow($v, $exponent);

array_walk($digits, $myFunc2);
print_r($digits);