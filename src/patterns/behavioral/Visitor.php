<?php

require_once '../../../vendor/autoload.php';

// Visitor, Odwiedzający

// Odwiedzający to behawioralny wzorzec projektowy pozwalający oddzielić algorytmy od obiektów na których pracują.
// Hisotryjka z architektektem co nie pozwala ruszyc klas na produckji a maja byc tworzone xmle z nich

// Kiedy stosowac :
// 1. Stosuj wzorzec Odwiedzający gdy istnieje potrzeba wykonywania jakiegoś działania na wszystkich elementach
// złożonej struktury obiektów (jak drzewo obiektów).
// 2.  Stosowanie Odwiedzającego pozwala uprzątnąć logikę biznesową czynności pomocniczych.
// 3. Warto stosować ten wzorzec gdy jakieś zachowanie ma sens tylko w kontekście niektórych klas wchodzących w skład hierarchii klas,
// ale nie wszystkich.

// Zalety

// 1. Zasada otwarte/zamknięte. Pozwala wprowadzać nowe zachowanie odnoszące się do obiektów różnych klas bez konieczności zmiany tych klas.
// 2. Zasada pojedynczej odpowiedzialności. Można przenieść kilka wersji danego zachowania do jednej klasy.
// 3. Obiekt odwiedzający może zebrać użyteczne informacje współpracując z różnymi obiektami. Może się to przydać, gdy zaistnieje potrzeba przejrzenia złożonej struktury danych element po elemencie (takiej jak drzewo obiektów) i zastosowania odwiedzającego do każdego obiektu struktury.

// Wady:
// 1. Trzeba zaktualizować wszystkich odwiedzających za każdym razem gdy hierarchia elementów zyskuje nową klasę lub którąś traci.
// 2. Odwiedzający mogą nie mieć dostępu do prywatnych pól i metod elementów z którymi mają współpracować.



use Spatie\ArrayToXml\ArrayToXml;

interface Element
{
    public function getData(): array;
    public function accept(Visitor $visitor);
}

class Invoice implements Element
{
    private string $signature;
    private float $value;

    public function __construct(string $signature, float $value)
    {
        $this->signature = $signature;
        $this->value = $value;
    }

    public function getSignature(): string
    {
        return $this->signature;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function accept(Visitor $visitor)
    {
        $visitor->visitInvoice($this);
    }

    public function getData(): array
    {
        return [
            'signature' => $this->signature,
            'value' => $this->value,
        ];
    }


}

class PersonalInvoice implements Element
{
    private string $name;
    private string $surname;
    private Invoice $invoice;

    public function __construct(string $name, string $surname, Invoice $invoice)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->invoice = $invoice;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getInvoice(): Invoice
    {
        return $this->invoice;
    }

    public function getData(): array
    {
        return [
            'name' => $this->name,
            'surname' => $this->surname,
            'invoice' => $this->invoice->getData(),
        ];
    }

    public function accept(Visitor $visitor)
    {
        $visitor->visitPersonalInvoice($this);
    }


}

interface Visitor
{
    public function visitInvoice(Invoice $element);
    public function visitPersonalInvoice(PersonalInvoice $element);
}

class XMLExportVisitor implements Visitor
{
    public function visitInvoice(Invoice $element): string
    {

        return ArrayToXml::convert($element->getData());
    }

    public function visitPersonalInvoice(PersonalInvoice $element): string
    {
        return ArrayToXml::convert($element->getData());
    }
}

// drogocenne obiekty, maja tylko jedna metode uruchamiajaca vistora
$invoice = new Invoice('invoice-1', 1567.34);
$personalInvoice = new PersonalInvoice('Piotr', 'Kowerzanow', $invoice);

$visitor = new XMLExportVisitor();

$xmlInvoice = $visitor->visitInvoice($invoice);
$xmlPersonalInvoice = $visitor->visitPersonalInvoice($personalInvoice);

var_dump($xmlInvoice);
var_dump($xmlPersonalInvoice);

