<?php

declare(strict_types=1);

namespace Tools;

use PHPUnit\Framework\TestCase;
use PkowerzMacwro\GitSandbox\Tools\InputSanitizer;

class InputSanitizerTest extends TestCase
{
    /**
     * @dataProvider checkCasesForDataSanitizer
     */
    public function testSanitize(string $expected, string $testCase): void
    {
        $sut = new InputSanitizer();

        $sanitized = $sut->sanitize($testCase);

        $this->assertEquals($expected, $sanitized);
    }

    public function checkCasesForDataSanitizer(): \Generator
    {
        yield "simple html string #1" => [
            "&amp;lt;a href='test'&amp;gt;Test&amp;lt;/a&amp;gt;",
            "<a href='test'>Test</a>"
        ];
        yield "simple html string #2" => [
            "&amp;lt;a href='test'&amp;gt;Test&amp;lt;/a&amp;gt;",
            "<a href='test'>Test</a>"
        ];
    }
}
