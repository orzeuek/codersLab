<?php

$z = new XMLReader;
$z->open('uwm.xml');

while ($z->read()){
    if($z->nodeType == XMLReader::ELEMENT && $z->name == 'level'){

    }

    if($z->nodeType == XMLReader::ELEMENT && $z->name == 'section_listing'){

    }
}
