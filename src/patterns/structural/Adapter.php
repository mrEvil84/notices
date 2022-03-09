<?php

// MT: uzywanie starych klas które, mają niekompatybilny interfejs z naszą aplikacją


// Adapter jest strukturalnym wzorcem projektowym pozwalającym na współdziałanie ze sobą
// obiektów o niekompatybilnych interfejsach.

// Kiedy stosowac :
// 1. Stosuj klasę Adapter gdy, chcesz wykorzystać jakąś istniejącą klasę,
// ale jej interfejs nie jest kompatybilny z resztą twojego programu.
// 2. Stosuj ten wzorzec gdy chcesz wykorzystać ponownie wiele istniejących podklas którym.
//    brakuje jakiejś wspólnej funkcjonalności, niedającej się dodać do ich nadklasy.
//
// Zalety:
// 1. SRP. Zasada pojedynczej odpowiedzialności.
//    Można oddzielić interfejs lub kod konwertujący dane od głównej logiki biznesowej programu.
// 2. OCP. Zasada otwarte/zamknięte.
//    Można wprowadzać do programu nowe typy adapterów bez psucia istniejącego kodu klienckiego,
//    o ile będzie on korzystał z adapterów poprzez interfejs kliencki.
// 3.
// Wady
// 1. Ogólna złożoność kodu zwiększa się, ponieważ trzeba wprowadzić zestaw nowych interfejsów i klas.
// Czasem łatwiej zmienić klasę udostępniającą jakąś potrzebną usługę, aby pasowała do reszty kodu.

class LegacyServiceTreeDrawer
{
    public function drawTree(int $levels, string $char): void
    {
        for ($i = 0; $i < $levels; $i++) {
            for ($j = 0; $j < $i; $j++) {
                echo '*';
            }
            echo PHP_EOL;
        }
    }
}

abstract class Tree
{
    public int $high;
    public string $leafsSign;
}

class ChristmasTree extends Tree
{
}

interface ClientDrawer
{
    public function draw(Tree $tree): void; // inna lista argumentow niz w klasie LegacyServiceTreeDrawer
}

class Adapter implements ClientDrawer // adapter musi umiedc w interfejs aktualny oraz wiedziec jak wywolac metode klasy legacy
{
    private LegacyServiceTreeDrawer $adaptee;

    public function __construct(LegacyServiceTreeDrawer $adaptee)
    {
        $this->adaptee = $adaptee;
    }

    public function draw(Tree $tree): void
    {
        $this->adaptee->drawTree($tree->high, $tree->leafsSign);
    }
}

$tree = new ChristmasTree();
$tree->high = 6;
$tree->leafsSign = 'x';

$adapter = new Adapter(new LegacyServiceTreeDrawer());
$adapter->draw($tree);
