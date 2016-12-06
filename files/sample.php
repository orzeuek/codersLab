<?php


var_dump(__DIR__);

$expectedDir = __DIR__.DIRECTORY_SEPARATOR."files_uploaded";

mkdir($expectedDir);
chmod($expectedDir, 0777);

var_dump(is_dir($expectedDir));
var_dump(file_exists($expectedDir));
