<?php

spl_autoload_register(function($className){
    require_once $className.".php";
});


$a = new ClassA();
$b = new ClassB();

spl_autoload_register(function($className){
    require_once $className."123.php";
});