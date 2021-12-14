<?php

declare(strict_types=1);

namespace timeAndDate;
trait DateTimeUtils
{
    public static function isLeapYear(int $checkedYear): bool
    {
        $isLeapYear = date('L', mktime(0, 0, 0, 1, 1, $checkedYear));

        return $isLeapYear === '1';
    }
}