<?php

namespace PkowerzMacwro\GitSandbox\Tools;

class InputSanitizer
{
    public function sanitize(string $input): string
    {
        return htmlspecialchars(
            htmlentities($input)
        );
    }
}