<?php

namespace PkowerzMacwro\GitSandbox\phoneKeyboard;

class PhoneKeyboard
{
    public static array $keyMap = [
        'a' => 2,
        'b' => 22,
        'c' => 222,
        'd' => 3,
        'e' => 33,
        'f' => 333,
        'g' => 4,
        'h' => 44,
        'i' => 444,
        'j' => 5,
        'k' => 55,
        'l' => 555,
        'm' => 6,
        'n' => 66,
        'o' => 666,
        'p' => 7,
        'q' => 77,
        'r' => 777,
        's' => 7777,
        't' => 8,
        'u' => 88,
        'v' => 888,
        'w' => 9,
        'x' => 99,
        'y' => 999,
        'z' => 9999
    ];

    public static function translate(string $word, array $keyMap): string
    {
        $wordData = mb_str_split($word);
        $translated = '';
        foreach ($wordData as $letter) {
            if (array_key_exists(mb_strtolower($letter), $keyMap)) {
                $translated .= $keyMap[mb_strtolower($letter)];
            } else {
                $translated .= '-';
            }
        }

        return $translated;
    }

}


echo PhoneKeyboard::translate('PIES', PhoneKeyboard::$keyMap) . PHP_EOL;
