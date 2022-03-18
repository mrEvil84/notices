<?php

class MoneyChanger
{
    public const EURO_COINS_TRANSLATOR = [
        '2 eur' => 200,
        '1 eur' => 100,
        '50 cent' => 50,
        '20 cent' => 20,
        '10 cent' => 10,
        '5 cent' => 5,
        '2 cent' => 2,
        '1 cent' => 1
    ];
    private array $coinsCounter = [];
    private array $coinsTranslator;

    public function __construct(array $coinsTranslator = self::EURO_COINS_TRANSLATOR)
    {
        $this->coinsTranslator = $coinsTranslator;
    }

    public function getChange(float $amount): array
    {
        $this->calculateCoinsAmount($amount);
        return $this->coinsCounter;
    }

    private function getFirstElementFromAssocData(array $assocData): array
    {
        [$k] = array_keys($assocData);
        return [$k => $assocData[$k]];
    }

    private function calculateCoinsAmount(float $amount): void
    {
        $normalizedAmount = $amount * 100;
        $coinsChange = [];

        // get coin division stats
        foreach ($this->coinsTranslator as $coinName => $coinValue) {
            $coinsChange[$coinName] = $normalizedAmount / $coinValue;
        }

        asort($coinsChange); // sort, smallest value on the top
        // filter: smallest but not bellow 1, avoid zero division
        $positive = array_filter($coinsChange, static function ($number) {
            return $number >= 1.0;
        });
        // select only smallest positive division number
        $smallest = $this->getFirstElementFromAssocData($positive);

        $smallestKey = array_keys($smallest)[0];
        $smallestValue = array_values($smallest)[0];

        // set numer of coins and coin name to result stats
        $this->coinsCounter[$smallestKey] = (int)$smallestValue;

        // substract from normalized amount multiplied coin value
        $newAmount = ($normalizedAmount - ((int)$smallestValue * $this->coinsTranslator[$smallestKey])) / 100;

        if ($newAmount <= 0) {
            return;
        }

        $this->calculateCoinsAmount($newAmount);
    }

}


$mc = new MoneyChanger();
$change = $mc->getChange(6.43);
echo '-------------------' . PHP_EOL;
print_r($change);

$amount = 0;
foreach ($change as $coinName => $coinAmount) {
    echo $coinName . ' ' . $coinAmount . PHP_EOL;
    $amount += $coinAmount * MoneyChanger::EURO_COINS_TRANSLATOR[$coinName];
}

echo 'Check : ' . $amount/100 . PHP_EOL;


//$coinsCounter = [];
//
//function array_kshift(&$arr)
//{
//    list($k) = array_keys($arr);
//    $r  = [$k => $arr[$k]];
//    unset($arr[$k]);
//    return $r;
//}
//
//
//function getChange(float $amount, &$coinsCounter)
//{
//    var_dump(' [[ ' . $amount . ' ]] ');
//
//    $coinsTab = [
//        '2 eur' => 200,
//        '1 eur' => 100,
//        '50 cent' => 50,
//        '20 cent' => 20,
//        '10 cent' => 10,
//        '5 cent' => 5,
//        '2 cent' => 2,
//        '1 cent' => 1
//    ];
//
//    $uCounter = $amount * 100;
//    $coinsChange = [];
//
//    foreach ($coinsTab as $coinName => $coinValue) {
//        $k = $uCounter / $coinValue;
//        echo $uCounter . ' / ' . $coinValue . ' = ' . $k . PHP_EOL;
//        $coinsChange[$coinName] = $k;
//    }
//    asort($coinsChange);
//    // smallest but not bellow 1
//
//    $positive = array_filter($coinsChange, function ($number) {
//        return $number >= 1.0;
//    });
//
//    $smallest = array_kshift($positive);
//
//
//    $smallestKey = array_keys($smallest)[0];
//    $smallestValue = array_values($smallest)[0];
//
//    $coinsCounter[$smallestKey] = (int)$smallestValue;
//
//    $newAmount = ($uCounter - ((int)$smallestValue * $coinsTab[$smallestKey])) / 100;
//
//    if ($newAmount <= 0) {
//        return;
//    } else {
//        getChange($newAmount, $coinsCounter);
//    }
//}
//
//
//getChange(5.99, $coinsCounter);
//
//echo '-------------------' . PHP_EOL;
//print_r($coinsCounter);
