<?php
declare(strict_types=1);

namespace PkowerzMacwro\GitSandbox\strings;

class WordReverser
{
    public static function getReversed(string $test, string $separator = " "): string
    {
        $exploded = explode($separator, $test);

        $reversedWords = [];
        foreach ($exploded as $word) {
            $wordLength = mb_strlen($word);
            $splitted = mb_str_split($word);
            $reversedWord = [];
            for ($i = $wordLength - 1; $i >= 0; $i--) {
                $reversedWord[] = $splitted[$i];
            }
            $reversedWords[] = implode("", $reversedWord);
        }

        return implode($separator, $reversedWords);
    }
}