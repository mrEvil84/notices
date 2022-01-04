<?php
trait Foo {
    final public function hello($s) { print "$s, hello!"; }
}
class Bar {
    use Foo;
    // Overwrite, no error
    final public function hello($s) { print "hello, $s!"; }
}

abstract class Foo2 {
    final public function hello($s) { print "$s, hello!"; }
}
class Bar2 extends Foo2 {
    // Fatal error: Cannot override final method Foo::hello() in ..
    final public function hello($s) { print "hello, $s!"; }
}

$bar = new Bar();