<?php

function prettyPrint($regexp, $string)
{
    $match = preg_match($regexp, $string);
    echo "regexp: \"$regexp\"   on string: \"$string\"    gave us: ";
    echo intval($match).PHP_EOL;
}

$string1 = "Ala ma kota";
$string2 = "Aga ma kota";
$string3 = " xxx Ala ma kota ";
$string4 = "xxx xxx Ala ma kota";
$string5 = "November 23";
$string6 = "Nov 23";
$string7 = "Ala=Ala";
$string8 = "bla bla bla";
$string9 = "[[jakieś słowa]]";
$string10= "[[jakieś] [słowa]]]";
$string11= "[[jakieś]] [[słowa]]";
$string12= "{START} Ala {END} ma {START} kota {END}";


// bezpośrednie dopasowanie
prettyPrint("/Ala ma kota/", $string1);     // 1

// Dowolny znak z wyjątkiem znaku nowego wiersza
prettyPrint("/.la ma kota/", $string1);    // 1

// Jeden dowolny znak ze znaków lub przedziałów znajdujących się między nawiasami,
prettyPrint("/A[g-l]a ma kota/", $string2);     // 1
prettyPrint("/A[lL]a ma kota/", $string2);      // 0
prettyPrint("/A[a-zA-Z]a ma kota/", $string2);  // 1

// Jeden dowolny znak nieznajdujący się między nawiasami
prettyPrint("/.[^abcd]a ma kota/", $string1);   // 1
prettyPrint("/.[^lg]a ma kota/", $string1);     // 0

// Grupa symboli do późniejszego wykorzystania
prettyPrint("/.(l)+a ma kota/", $string1);      // 1
prettyPrint("/.(g)+a ma kota/", $string1);      // 0

//
prettyPrint("/.(l){1,2}a ma kota/", $string1);      // 1

// "|" To odpowiednik słowa lub, oznacza wystąpienie jednego podanych wyrażeń
prettyPrint("/.(l|g)+a ma kota/", $string2);    // 1
prettyPrint("/.(a|b)+a ma kota/", $string2);    // 0

// początek & koniec wiersza
prettyPrint("/^Ala ma kota$/", $string1);   // 1
prettyPrint("/Ala ma kota/", $string3);     // 1
prettyPrint("/^Ala ma kota$/", $string3);   // 0

// "*" zero lub więcej wystąpień poprzedzającego wyrażenia
prettyPrint("/(bla)*Ala ma kota/", $string1);   // 1
prettyPrint("/(Ala)* ma kota/", $string1);      // 1
prettyPrint("/(xxx )*Ala ma kota/", $string1);  // 1
prettyPrint("/(xxx )*Ala ma kota/", $string3);  // 1
prettyPrint("/(xxx )*Ala ma kota/", $string4);  // 1

// "+" jedno wystąpienie lub więcej poprzedzającego wyrażenia
prettyPrint("/(Ala)+ ma kota/", $string1);      // 1
prettyPrint("/(bla)+Ala ma kota/", $string1);   // 0
prettyPrint("/(xxx )+Ala ma kota/", $string1);  // 0
prettyPrint("/(xxx )+Ala ma kota/", $string3);  // 1
prettyPrint("/(xxx )+Ala ma kota/", $string4);  // 1

// "?" najwyżej jedno wystąpienie (może być zero) poprzedzającego wyrażenia
prettyPrint("/Nov(ember)?/", $string5);      // 1
prettyPrint("/Nov(ember)?/", $string6);      // 1

// odwołania wsteczne:
prettyPrint("/(\\w+)=\\1/", $string7);          // 1
prettyPrint("/((bla)+) \\1 \\1/", $string8);    // 1
prettyPrint("/(\\w+)(\\d+)\\2\\1/", "aa22bb33");    // 1

// przechwytywanie nazwane
// (?P<x>......) - <x> definicja nazwy grupy
// (P=x)         - odwołanie do grupy o nazwie
prettyPrint("/(?P<x>bla) (?P=x) (?P=x)/", $string8); // 1

// separatory
// z php.net:
// When using the PCRE functions, it is required that the pattern is enclosed by delimiters.
// A delimiter can be any non-alphanumeric, non-backslash, non-whitespace character.
prettyPrint("/Ala ma kota/", $string1);     // 1
prettyPrint("#Ala ma kota#", $string1);     // 1
prettyPrint("~Ala ma kota~", $string1);     // 1

// kwantyfikatory zachłanne:
// wstawiając .* oznacz, że łapiemy wszystko co jest w  [[ ]]
prettyPrint("#\\[\\[.*]\\]#", $string9);    // 1
prettyPrint("#\\[\\[.*]\\]#", $string10);   // 1
// chcemy być sprytniejsi, i jeśli w [[ ]] występują "]" to ma to być odseparowane
// użyjemy [^\]* żeby wyrażenie nie łąpało "]"
prettyPrint("#\\[\\[[^\\]]*]\\]#", $string9);   // 1
prettyPrint("#\\[\\[[^\\]]*]\\]#", $string10);  // 0
prettyPrint("#\\[\\[[^\\]]*]\\]#", $string11);  // 1

// niezachłanny tryb dopasowania
$regexp = "#{START}.*{END}#";

// zachłanny regep .* pomija wystąpienia {START} {END} w środku stringa
$matches1 = [];
$pregMatch1 = preg_match($regexp, $string12, $matches1);
echo "regexp: \"$regexp\"   on string: \"$string12\"    give us:" . PHP_EOL;
var_dump($pregMatch1);
var_dump($matches1);

// niezachłanny regexp matchuje wsyzstkie elementy wewnątrz pierwszego wystąpienia
// {START} {END}
$matches2 = [];
$pregMatch2 = preg_match("$regexp"."U", $string12, $matches2);
echo "regexp: \"$regexp"."U\"   on string: \"$string12\"    give us:" . PHP_EOL;
var_dump($pregMatch2);
var_dump($matches2);

