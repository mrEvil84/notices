<?php

// MT: stan wewnetrzny - wspolny dla wszystkich obiektow , stan zewnetrzny to dany stan (zmieniajacy sie czesto) danego obiektu
// MT: sadzenie drzewek w lesie, stan wewn. to kolor drzewa, zewnetrzny położenie.

// Pyłek jest strukturalnym wzorcem projektowym pozwalającym zmieścić więcej obiektów w danej przestrzeni pamięci RAM poprzez współdzielenie części opisu ich stanów.
// Stan wewnetrzny ktory jest duzy przechowywany jest w klasie-pylek , dane te sa wspolne dla wielu podobnyh obiektow np. drzew
// Stan zewnetrzny ktory jest zmienny np. pozycja malowania na ekranie jest zmienna
// Tworzenie pylku zeby sie nie powtarzac , jest za pomoca fabryki


// klasa pyłka przechowujaca wewnetrzny stan obiektu wspolny dla grupy obiektow
class TreeTypeFlyweight
{
    private string $name;
    private string $color;
    private string $texture;

    public function __construct(string $name, string $color, string $texture)
    {
        $this->name = $name;
        $this->color = $color;
        $this->texture = $texture;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getTexture(): string
    {
        return $this->texture;
    }
}

// klasa cotextu , zawiera stan zewnetrzny drzewa
class Tree
{
    private int $x;
    private int $y;
    private TreeTypeFlyweight $treeTypeFlyweight;

    public function __construct(int $x, int $y, TreeTypeFlyweight $treeTypeFlyweight)
    {
        $this->x = $x;
        $this->y = $y;
        $this->treeTypeFlyweight = $treeTypeFlyweight;
    }

    public function draw(): void
    {
        echo 'x : '
            . $this->x
            . ' y : '
            . $this->y
            . ' : '
            . $this->treeTypeFlyweight->getName()
            . ': '
            . $this->treeTypeFlyweight->getColor()
            . ': '
            . $this->treeTypeFlyweight->getTexture()
            . PHP_EOL;
    }
}

// stan wewnetrzny , (duze obiekty etc.) ktore sa wspolne dla wielu obiektow przechowywany jest w pylku
class TreeTypeFactory
{
    private array $treeTypesFleiweight;

    public function getTreeTypeFleiweight(string $name, string $color, string $texture): TreeTypeFlyweight
    {
        if (!empty($this->treeTypesFleiweight[$name][$color][$texture])) {
            return $this->treeTypesFleiweight[$name][$color][$texture];
        }

        $treeTypeFleiweight = new TreeTypeFlyweight($name, $color, $texture);
        $this->treeTypesFleiweight [$name][$color][$texture][] = $treeTypeFleiweight;

        return $treeTypeFleiweight;
    }
}

 class Forest
 {
     private array $trees;

     public function add(Tree $tree): void
     {
         $this->trees [] = $tree;
     }

     public function draw(): void
     {
         /** @var Tree $tree */
         foreach ($this->trees as $tree) {
             $tree->draw();
         }
     }
 }

    $treeTypeFactory = new TreeTypeFactory();
    $treeTypeFleiweight = $treeTypeFactory->getTreeTypeFleiweight('klon', 'czerwony', 'chropowata');

    $forest = new Forest();
    // sadzenie drzewek
    for ($i = 0; $i < 1000; $i++) {
        $forest->add(new Tree($i, $i+1, $treeTypeFleiweight));
    }

    $forest->draw();

    var_dump($treeTypeFactory);

