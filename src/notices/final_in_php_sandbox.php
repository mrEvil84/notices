<?php

class parentClass {
    final public function someMethod(): void
    {

    }
}
class childClass extends parentClass {
    public function someMethod(): void
    {

    }
}

$child = new childClass();
