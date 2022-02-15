<?php

namespace PkowerzMacwro\GitSandbox\spl\various;

use ArrayObject;

class ArrayObjectSandobox
{

}

// ArrayObject - allows objects to work as arrays.

$props = [];
$data = new ArrayObject($props, ArrayObject::ARRAY_AS_PROPS);

$data->prop1 = 'a';
$data->prop2 = 'b';
$data->append('c');

var_dump($data->offsetGet('prop1'));
