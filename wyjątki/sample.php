<?php

class DivisionByZeroException extends Exception {

    public function __construct()
    {
        parent::__construct("Division by zero is forbidden!");
    }
}

/**
 * @param $divident
 * @param $divisor
 * @return float|int
 * @throws DivisionByZeroException
 */
function divide($divident, $divisor){

    if($divisor == 0) {
        throw new DivisionByZeroException();
    }
    return $divident / $divisor;
}



try {
    try{
        var_dump( divide(2,0) );
    } catch (DivisionByZeroException $e){
        file_put_contents("log.log", $e->getMessage().PHP_EOL);
        throw $e;
    }
    var_dump(divide(2,4));
} catch (Exception $e) {
    echo "Drogi użytkowniku, wykryto błąd!";
}
