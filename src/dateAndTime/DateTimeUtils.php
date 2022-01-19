<?php

declare(strict_types=1);

namespace PkowerzMacwro\GitSandbox\dateAndTime;

use DateTime;

trait DateTimeUtils
{
    public static function isLeapYear($checkedYear): bool
    {
        $date = new DateTime();
        $date->setDate($checkedYear, 1, 1);
        $isLeapYear = date('L', $date->getTimestamp());

        return $isLeapYear === '1';
    }
}
