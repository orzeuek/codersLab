<?php
interface A {
    function foo();
}

interface B {
    function foo();
}

class C implements A,B{

    public function foo()
    {
        return "aaa";
    }
}

$c = new C();

var_dump($c->foo());