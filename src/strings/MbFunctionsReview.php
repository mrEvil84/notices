<?php

require_once '../../vendor/autoload.php';

use PkowerzMacwro\GitSandbox\strings\WordReverser;
use PkowerzMacwro\GitSandbox\strings\WordLimiter;

$test = 'Piotr Kowerzanow';
$reversed = WordReverser::getReversed($test);
echo $reversed . PHP_EOL;


$check = mb_check_encoding($test, 'UTF-8'); // check if strings are valid for the specified encoding
var_dump($check);
$detect = mb_detect_encoding($test, null, true);
var_dump($detect);
$width = mb_strwidth('abc d');
var_dump($width);

var_dump(WordLimiter::limit($test, 6));


// most_popular
// substr
// strlen
// strreplace
// trim
// strpos
// strstr
// strtolower
// strtoupper
// is_string