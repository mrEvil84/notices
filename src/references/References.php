<?php


class Foo
{
    public static function append(string &$text, string $appednerText): void
    {
        $text .= ' ' . $appednerText;
    }
}

$test = 'Some text';
Foo::append($test, 'appedix');

var_dump($test);
