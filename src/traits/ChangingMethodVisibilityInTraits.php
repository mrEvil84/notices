<?php

trait HelloWorld {
    public function sayHello() {
        echo 'Hello World!';
    }
    abstract public function getWorld(): string;
    public static function doingSth(): string
    {
        return 'doing something';
    }
    public static string $name = 'HelloWorldTrait';
}

// Change visibility of sayHello
class MyClass1 {
    use HelloWorld { sayHello as protected; }

    public function getWorld(): string
    {
        return 'world';
    }

}

// Alias method with changed visibility
// sayHello visibility not changed
class MyClass2 {

    use HelloWorld { sayHello as private myPrivateHello; }

    public function getWorld(): string
    {
        return 'world!';
    }


}

class MyClass3 extends MyClass2
{
    public function sayHello3(): void
    {
        $this->sayHello();
    }

    public function getWorld(): string
    {
        return 'World';
    }
}

$mc2 = new MyClass2();
$mc2->sayHello();

$mc3 = new MyClass3();
$mc3->sayHello3();
var_dump(MyClass3::doingSth());
var_dump(MyClass2::$name);