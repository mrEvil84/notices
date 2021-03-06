<?php

declare(strict_types=1);

namespace PkowerzMacwro\GitSandbox\strings;

class WordLimiter
{
    public const LIMIT = 100;

    public static function limit(string $word, int $limit = self::LIMIT, string $endSign = '...'): string
    {
        if (mb_strwidth($word, 'UTF-8') <= $limit) {
            return $word;
        }

        return rtrim(mb_strimwidth($word, 0, $limit, '', 'UTF-8')) . $endSign;
    }
}
