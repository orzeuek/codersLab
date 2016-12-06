<?php

function filter(){

}

$result = filter(
    [
        "mail@firma.pl",
        "http://wp.pl",
        "192.168.222.0"
    ]
);

// EXPECTED OUTPUT :
// [
//    "mail@firma.pl" => true,
//    "http://wp.pl" => true,
//    "192.168.222.0" => true
// ]