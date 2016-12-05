<?php

$iterator = new ArrayIterator(["x"=>"x1", "y"=>"y1", "z"=>"z1"]);

echo "FOREACH".PHP_EOL;
foreach ($iterator as $key => $value){
    echo "key: $key".PHP_EOL;
    echo "value: $value".PHP_EOL;
}

echo "WHILE".PHP_EOL;
$iterator->rewind();
while($iterator->valid()){
    $key = $iterator->key();
    $value = $iterator->current();

    echo "key: $key".PHP_EOL;
    echo "value: $value".PHP_EOL;

    $iterator->next();
}