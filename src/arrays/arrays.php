<?php

# BASICS

# array_keys -> return keys from array
# array_values -> return values from array
# array_flip -> exchanges keys with values
# array_combine -> array_combine(keys,values) -> create assoc array
# in_array -> return true if array contains searched value
# array_key_exists -> return true if key exists in array


//$keys = ['id', 'name', 'surname', 'city'];
//$values = [1234, 'Piotr', 'Kowerzanow', 'Różyny'];

//$dataSet = array_combine($keys, $values);

//var_dump($dataSet);

//var_dump(array_keys($dataSet));
//var_dump(array_values($dataSet));
//var_dump(array_flip($dataSet));
//var_dump(array_search('Piotr', $dataSet, false)); // return index of searched value
//var_dump(in_array('Różyny', $dataSet)); // return true if array contains searched value
//var_dump(array_key_exists('name', $dataSet)); // return true if key exists in array


# LIST

# list() - get values from array

//        //Enter your code here, enjoy!
//        function getData() {
//            return [1,2,3,4,5];
//        }


//$secElement = getData()[1];

//var_dump($secElement);
//list(,,$thirdElement) = getData();
//
//var_dump($thirdElement);

//$info = array('coffee', 'brown', 'caffeine');
// Listing all the variables
//list($drink, $color, $power) = $info;

//$text = 'hello|wild|world';
//list($hello, , $world) = explode('|', $text);
//echo ("$hello $world");

//$coordinates = [
//    [1,2],
//    [1,3],
//    [1,4],
//];
//
//    foreach ($coordinates as list($a, $b)) {
//        $c = $a + $b;
//        var_dump('C = ' . $c);
//    }


# ARRAY_SEARCH - search in array

// array_search - search per value in array , if strict then search value strictly typed

// array_search . strict
//$dataSetNext = ['100', 100, 200, '200'];
//var_dump(array_search(100, $dataSetNext));
//var_dump(array_search(100, $dataSetNext, true));


# EXTRACT & COMPACT

// extract , value with the name of a key and value of element value
// pl: wyciaga zmienne o nazwach takich samych jak nazwy klucza


//$dataSetClothes = [
//    'clothes' => 'tshirt',
//    'size' => 'XL',
//    'color' => 'red',
//    'price' => 10.30,
//];
//
//extract($dataSetClothes);
//var_dump($clothes, $size, $color, $price);


// compact - opposite of extract
// pl: tworzy tablice assoc z nazwami kluczy jak nazwy zmiennych i wartosciami jak wartości zmiennych

//$clothes = 'thisrt';
//$size = 'XL';
//$price = 12.30;
//$dataSetClothes2 = compact('clothess', 'size', 'price');
//var_dump($dataSetClothes2);



// # ARRAY_FILTER


// array_filter, call without callback -> removes empty values

// filter with lambdas

//$comparator = function ($max) {
//  return function ($v) use ($max) { return $v > $max; };
//};
//
//$numbers = [-1,0,1,2,3,4,5,6,7,8];
//var_dump(array_filter($numbers, $comparator(4)));
//var_dump(array_filter($numbers, $comparator(7)));


//$numbers = [20, -3, 50, -99, 55];
//$positive = array_filter($numbers, function($number) {
//    return $number > 0;
//});
//$negative = array_filter($numbers, function ($number) {
//   return $number < 0;
//});
//var_dump($positive);
//var_dump($negative);

// remove empty values -> call without callback func.

//$dataSetWithEmptyValues = [-1,0,null,1,2]; // 0 - empty
//$cleared = array_filter($dataSetWithEmptyValues);
//
//var_dump($cleared);


# ARRAY_UNIQUE - get unique values , Notice that the function will preserve the keys of the first unique elements

//$dataSetForUniqueTesting = [1,1,2,2,3,3,3,3,4,5,6];
//var_dump(array_unique($dataSetForUniqueTesting));


# ARRAY_COLUMN -> get data from column and return this data as array

//$selectColumn = [
//    ['x' => 1, 'y' => 1, 'z' => 10],
//    ['x' => 2, 'y' => 1, 'z' => 10],
//    ['x' => 3, 'y' => 1, 'z' => 10],
//    ['x' => 4, 'y' => 1, 'z' => 10],
//];
//
//var_dump(array_column($selectColumn, 'x'));


# ARRAY_MAP - walking through arrays

//$cities = ['warsaw', 'LONDON', 'Paris'];
//$uppercased = array_map('strtoupper', $cities);
//$lowercased = array_map('strtolower', $cities);
//
//var_dump($uppercased, $lowercased);

//$numbers = [1,2,3,4,5,6,7];

//$multiplied = array_map(function ($n) {
//    return $n*$n;
//}, $numbers);

// pass array keys and values to callback

//$model = ['id' => 7, 'name' => 'Piotr'];
//$callback = static function ($key, $value) {
//    return ['key'=> $key, 'value' => $value];
//};
//$res = array_map($callback, array_keys($model), $model);
//
//var_dump($res);


// #ARRAY_WALK
// array walk -> same like array_map but work different -> work on reference instead of copy

//$fruits = [
//    'banana' => 'yellow',
//    'apple' => 'green',
//    'orange' => 'orange',
//];
//
//array_walk($fruits, function(&$value, $key) {
//    $value = "$key is $value";
//});
//
//print_r($fruits);


// JOINING ARRAYS

# ARRAY_MERGE

// #array_merge -> values with the same string keys will be overwritten with the last value
//$array1 = ['a' => 'a', 'b' => 'b', 'c' => 'c'];
//$array2 = ['a' => 'A', 'b' => 'B', 'D' => 'D'];
//
//$merge = array_merge($array1, $array2);
//print_r($merge);


# ARRAY_DIFF

// Multiple occurrences in $array1 are all treated the same way
// return this from 1 array that not in second one

//$array1 = array("a" => "green", "red", "blue", "red");
//$array2 = array("b" => "green", "yellow", "red");

//$result = array_diff($array2, $array1);
//print_r($result); // yellow

//$array3 = [1,2,3,4];
//$array4 = [1,2,4,5];

//$result2 = array_diff($array3, $array4);

//print_r($result2);


# ARRAY_INTERSECT

// array_intercect - returns array with same elements from two arrays

//$result3 = array_intersect($array4, $array3);
//print_r($result3);

# MATH CALCULATIONS

$numbers = [1, 2, 3, 4, 5];

# array_sum

//echo(array_sum($numbers)); // 15

# array_product

//echo(array_product($numbers)); // 120

//$callback1 = function($carry, $item) {
//
//    return $carry ? $carry / $item : 1;
//};
//
//$callback2 = function ($carry, $item) {
//     return $carry ? $carry+=$item : 1;
//};

# array_reduce

//echo(array_reduce($numbers, $callback1)); // 0.0083 = 1/2/3/4/5
//echo(array_reduce($numbers, $callback2)); // 0.0083 = 1/2/3/4/5

//$things = ['apple', 'apple', 'banana', 'tree', 'tree', 'tree'];
//$values = array_count_values($things);
//
//print_r($values);



# Generating arrays


# array_fill, range

//$bind = array_fill(0,5, '*');
//print_r($bind);
//

# range
//$letters = range('a','z');
//print_r($letters);
//
//$hours = range(0,23);
//print_r($hours);
//


# array_fill_keys
//$keys = ['x','y','z'];
//$coordinates = array_fill_keys($keys, 1);
//print_r($coordinates);



# ARRAY_SORTING

// It is good to remember that every sorting function in PHP works with arrays
// by a reference and returns true on success or false on failure.

//a, sort preserving keys
//k, sort by keys
//r, sort in reverse/descending order
//u, sort with a user function

//        a	        k	        r	        u
//a	    asort()                 arsort()	uasort()
//k                 ksort()	    krsort()
//r	    arsort()	krsort()	rsort()
//u	    uasort()                            usort()

$data = [1,0,-1,100,21,-23];
$data2 = [
    'b' => -1,
    'a' => 100,
    'c' => 23,
];

//sort($data2);
//asort($data2);
//ksort($data2);
//rsort($data2);

//print_r($data);
//print_r($data2);



# Combinig like a boss

//$values = ['say  ', '  bye', ' ', ' to', ' spaces ', '   '];
//$words = array_filter(array_map('trim', $values));
//print_r($words);

//$letters = ['a', 'a', 'a', 'a', 'b', 'b', 'c', 'd', 'd', 'd', 'd', 'd'];
//$values = array_count_values($letters); // get key to count array
//arsort($values);
//$top = array_slice($values, 0, 3);
//print_r($top);

//$words2 = ['aa', '', 'bbb', 'ccc','aa','aa','bb'];
//$words2Count = array_count_values(
//    array_filter(
//        array_map('trim',$words2)
//    )
//);
//print_r($words2Count);

//$order = [
//    ['product_id' => 1, 'price' => 99, 'count' => 1],
//    ['product_id' => 2, 'price' => 50, 'count' => 2],
//    ['product_id' => 2, 'price' => 17, 'count' => 3],
//];
//
//$sum = array_sum(array_map(function($product_row) {
//    return $product_row['price'] * $product_row['count'];
//}, $order));
//
//print_r($sum); // 250