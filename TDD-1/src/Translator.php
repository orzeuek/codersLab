<?php

class Translator
{

    const SINGLE_DIGIT_1 = "jeden";
    const SINGLE_DIGIT_2 = "dwa";
    const SINGLE_DIGIT_3 = "trzy";
    const SINGLE_DIGIT_4 = "cztery";
    const SINGLE_DIGIT_5 = "pięć";
    const SINGLE_DIGIT_6 = "sześć";
    const SINGLE_DIGIT_7 = "siedem";
    const SINGLE_DIGIT_8 = "osiem";
    const SINGLE_DIGIT_9 = "dziewięć";
    const SINGLE_DIGIT_0 = "zero";

    const DOUBLE_DIGIT_10 = "dziesięć";
    const DOUBLE_DIGIT_11 = "jedenaście";
    const DOUBLE_DIGIT_12 = "dwanaście";
    const DOUBLE_DIGIT_13 = "trzynaście";
    const DOUBLE_DIGIT_14 = "czternaście";
    const DOUBLE_DIGIT_15 = "piętnaście";
    const DOUBLE_DIGIT_16 = "szesnaście";
    const DOUBLE_DIGIT_17 = "siedemnaście";
    const DOUBLE_DIGIT_18 = "osiemnaście";
    const DOUBLE_DIGIT_19 = "dziewiętnaście";

    const DOUBLE_DIGIT_20 = "dwadzieścia";
    const DOUBLE_DIGIT_30 = "trzydzieści";
    const DOUBLE_DIGIT_40 = "czterdzieści";
    const DOUBLE_DIGIT_50 = "pięćdziesiąt";
    const DOUBLE_DIGIT_60 = "sześćdziesiąt";
    const DOUBLE_DIGIT_70 = "siedemdziesiąt";
    const DOUBLE_DIGIT_80 = "osiemdziesiąt";
    const DOUBLE_DIGIT_90 = "dziewięćdziesiąt";

    const TRIPLE_DIGIT_100 = "sto";
    const TRIPLE_DIGIT_200 = "dwieście";
    const TRIPLE_DIGIT_300 = "trzysta";
    const TRIPLE_DIGIT_400 = "czterysta";
    const TRIPLE_DIGIT_500 = "pięćset";
    const TRIPLE_DIGIT_600 = "sześćset";
    const TRIPLE_DIGIT_700 = "siedemset";
    const TRIPLE_DIGIT_800 = "osiemset";
    const TRIPLE_DIGIT_900 = "dziewięćset";

    public function translate(int $number)
    {
        if ($number < 10) {
            return $this->translateSingleDigit($number);
        } elseif ($number >= 10 && $number < 100) {
            return $this->translateDoubleDigitNumber($number);
        } else {
            return $this->translateTripleDigit($number);
        }
    }

    private function translateSingleDigit($number)
    {
        $constName = "self::SINGLE_DIGIT_$number";

        return constant($constName);
    }

    private function translateDoubleDigitNumber($number)
    {
        if ($number >= 10 && $number <= 19) {
            return constant("self::DOUBLE_DIGIT_$number");
        } elseif ($number >= 20 && $number < 100 && $this->isFullTenDigit($number)) {
            return constant("self::DOUBLE_DIGIT_$number");
        } elseif ($number >= 20 && $number < 100 && !$this->isFullTenDigit($number)) {
            $double = $this->getSecondDigitFromNumber($number);
            $single = $this->getSingleDigitFromNumber($number);
            return constant("self::DOUBLE_DIGIT_$double" . "0") . " " . constant("self::SINGLE_DIGIT_$single");
        } else {
            return $this->translateSingleDigit($number);
        }
    }

    private function translateTripleDigit($number)
    {
        if($this->isFullHundred($number)){
            $constName = "self::TRIPLE_DIGIT_$number";
            return constant($constName);
        } else {
            $hundreds = $this->getThirdDigitFromNumber($number);
            $constName = "self::TRIPLE_DIGIT_$hundreds"."00";
            return  constant($constName) .
            " " .
            $this->translateDoubleDigitNumber(
                $this->extractDecimal($number)
            );
        }
    }

    public function isZero($number)
    {
        return $number == 0;
    }

    public function isFullTenDigit(int $number)
    {
        return !($number % 10);
    }

    public function getSecondDigitFromNumber(int $number)
    {
        $string = (string)$number;
        return intval(substr($string, -2, 1));
    }

    public function getSingleDigitFromNumber($number)
    {
        $string = (string)$number;
        return intval(substr($string, -1, 1));
    }

    public function getThirdDigitFromNumber($number)
    {
        $string = (string)$number;
        return intval(substr($string, -3, 1));
    }

    public function isFullHundred(int $number)
    {
        return !($number % 100);
    }

    private function extractDecimal($number)
    {
        $string = (string) $number;
        return intval(substr($string, 1));
    }

}