<?php

require 'vendor/autoload.php';

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

$log = new Logger('infoLogger');
$log->pushHandler(new StreamHandler(__DIR__ . '/info.log', Logger::DEBUG));
$log->addInfo('skrypt rozpoczął działanie');

for($i = 0; $i < 10; $i++) {
    $log->addInfo($i . '. obrót pętli');
}
$log->addInfo('skrypt zakończył działanie');

