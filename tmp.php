<?php


$str = "Ala ma kota";

$exploded = explode(" ", $str);

echo 'echo $exploded[0];'.PHP_EOL;
echo $exploded[0];

echo PHP_EOL;
echo PHP_EOL;

echo 'echo foreach($exploded as $element){'.PHP_EOL;

foreach ($exploded as $element){
    echo $element.PHP_EOL;
}
