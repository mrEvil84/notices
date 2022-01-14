<?php

namespace PkowerzMacwro\GitSandbox\Tools;

class EmailValidator
{
    public const EMAIL_VALID_REGEX = '/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix';

    public static function isValid(string $email): bool
    {
        return preg_match(self::EMAIL_VALID_REGEX, $email) === 1;
    }
}