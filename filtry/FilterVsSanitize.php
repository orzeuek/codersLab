<?php

//var_dump(filter_var("a123456bsad", FILTER_SANITIZE_NUMBER_INT));
$x = (filter_var("12", FILTER_VALIDATE_INT));

var_dump($x);
var_dump( boolval( $x ) );





















