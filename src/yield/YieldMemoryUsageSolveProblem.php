<?php

// super opisane : https://sarvendev.com/pl/2018/06/generatory-w-php/


//Generatory są funkcjami, które pozwalają w wydajny sposób iterować po dużych zbiorach danych.
//Różnicą w składni w stosunku do zwykłej funkcji jest słowo kluczowe yield,
//którego użycie na pierwszy rzut oka przypomina użycie return

// przetwarzanie duzej tablicy

function getData() {
    $data = [];
    for ($i = 0; $i < 1000000; $i++) {
        $data[] = $i;
    }
    return $data;
}
//$data = getData() ;

// (!) Odpowiedź jest bardzo prosta, funkcja getData() musi całą tablicę najpierw skonstruować,
// a następnie dopiero po zwróconej tablicy iterujemy. Tutaj własnie znajdują zastosowanie Generatory.

function getData2() {
    for ($i = 0; $i < 10000000; $i++) {
        yield $i;
    }
}

// Przerobienie funkcji, aby korzystała z generatora jest jak widać bardzo proste.
// Warto zauważyć, że tym razem tablica nie jest od razu konstruowana w pamięci.
// Funkcja getData zwraca obiekt klasy Generator,
// która implementuje interfejs Iteratora, co pozwala na proste przetwarzanie w pętli foreach.


// Przetwarzanie dużego pliku :


//  kod tworzy plik o rozmiarze około 1GB.
//$file = fopen('file.txt', 'wb');
//for ($i = 0; $i < 1000000; $i++) {
//    fwrite($file, random_bytes(1024));
//}
//fclose($file);

//  proba przetwarznia linia po linii

//function getLines($file) {
//    $lines = [];
//    while ($line = fgets($file)) {
//        $lines[] = $line;
//    }
//    return $lines;
//}
//$file = fopen('file.txt', 'rb');
//$lines = getLines($file);
//fclose($file);
//foreach ($lines as $line) {
//}

function getLines($file)
{
    while ($line = fgets($file)) {
        yield $line;
    }
}
$file = fopen('file.txt', 'rb');
$lines = getLines($file);
//fclose($file);
foreach ($lines as $line) {
}
fclose($file);

die('stop');
