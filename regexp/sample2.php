<?php

$cytat = 'To jest jakiś tekst. "To jest cyctat1". To jest dalsza część tekstu. "To jest drugi cyctat".';

$res = [];

var_dump(preg_match_all('/".*"/U', $cytat, $res, PREG_PATTERN_ORDER));
var_dump($res);
