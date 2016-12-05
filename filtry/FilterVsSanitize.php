<?php

var_dump(filter_var(1, FILTER_SANITIZE_NUMBER_INT));
var_dump(filter_var(1, FILTER_VALIDATE_INT));

var_dump(filter_var("a", FILTER_SANITIZE_NUMBER_INT));
var_dump(filter_var("a", FILTER_VALIDATE_INT));

