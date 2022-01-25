<?php

namespace PkowerzMacwro\GitSandbox\patterns\creational\Prototype;

require_once '../../../../vendor/autoload.php';

// PROTOTYP
// Do zapamietania:   klonowanie, delegowanie do obiektow

// Prototyp to kreacyjny wzorzec projektowy, który umożliwia kopiowanie już istniejących obiektów
// bez tworzenia zależności pomiędzy twoim kodem, a klasami obiektów.
// Wzorzec projektowy Prototyp (!) deleguje proces klonowania samym obiektom, które mają być sklonowane

// Kiedy stosować ?
// 1. Stosuj wzorzec Prototyp gdy chcesz aby twój kod nie był zależny od konkretnej klasy kopiowanego obiektu.
// 2. Stosuj ten wzorzec gdy, chcesz zredukować ilość podklas różniących się jedynie sposobem inicjalizacji swych obiektów.
// 3. Ktoś inny bowiem mógł stworzyć takie podklasy tylko w celu tworzenia obiektów o określonej konfiguracji.

// Zalety:
// 1. Możesz klonować obiekty bez konieczności sprzęgania ze szczegółami ich konkretnych klas.
// 2. Możesz pozbyć się wielokrotnie powtarzanego kodu inicjalizacyjnego na rzecz klonowania prefabrykowanych prototypów.
// 3. Dużo wygodniejsze produkowanie złożonych obiektów.
// 4. Podejście to stanowi alternatywę do dziedziczenia w przypadku gdy mamy
//    do czynienia z wcześniej zdefiniowanymi konfiguracjami złożonych obiektów.
//
// Wady:
// 1.  Klonowanie złożonych obiektów, które mają odniesienia cykliczne, może być trudne.

//use PkowerzMacwro\GitSandbox\patterns\creational\Prototype\ApplePrototype;
//use PkowerzMacwro\GitSandbox\patterns\creational\Prototype\Cloner;

$applePrototype = new AppleLobo('lobo', 2.45);

$cloner = new Cloner($applePrototype);

$apples = [];
$clonesCount = 1000;

for ($i = 0; $i <= $clonesCount; $i++) {
    $apples[] = $cloner->clone();
}

var_dump($apples);
