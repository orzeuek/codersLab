<?php

//$xml = file_get_contents(__DIR__."/sample.xml");
//
////var_dump($xml->getName());
////var_dump($xml->course[0]);
//
////$x = $xml->xpath("course[@id=666]/subj/text()");
////
////var_dump($x);
////var_dump($xml);
//
//$dom = new DOMDocument;
//$dom->loadXML($xml);
//
//$xpath = new DOMXPath($dom);
//foreach ($xpath->query('course[@id=666]/subj/text()') as $textNode) {
//    var_dump($textNode->nodeValue);
//}


$ksiazka = simplexml_load_file('sample.xml');

$courses = $ksiazka->xpath('course');

foreach ($courses as $course){
    echo $course->reg_num . " ". $course->title.PHP_EOL;
}
































