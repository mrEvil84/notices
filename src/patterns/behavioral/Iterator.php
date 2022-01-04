<?php

// Iterator to behawioralny wzorzec projektowy, pozwalający sekwencyjnie przechodzić od elementu do elementu jakiegoś zbioru bez konieczności eksponowania jego formy (lista, stos, drzewo, itp.).

// Idea iteratora to przetwarzanie kolekcji, list, drzew , etc. delegując sposób przechodzenia po strukturze dla klasy
// która, daną strukturę wykorzystuje do przechowywania danych w kolekcjach

//Oprócz implementowania samego algorytmu,
// obiekt iteratora hermetyzuje wszystkie szczegóły sposobu przechodzenia przez kolejne elementy,
// jak bieżąca pozycja, czy ilość pozostałych elementów.
// Dzięki temu wiele iteratorów może jednocześnie przeglądać tę samą kolekcję, niezależnie od siebie.



