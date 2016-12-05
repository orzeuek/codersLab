<?php
namespace TddA1Sample;

/**
 * @author Rafał Orłowski <rafal.orlowski@assertis.co.uk>
 */
class NumbersTranslator
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

    public function translate($number)
    {
        if ($number < 10) {
            return $this->translateSingleDigit($number);
        } elseif ($number < 100) {
            return $this->translateDoubleDigitNumber($number);
        } elseif ($number < 1000) {
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
        if ($number < 20 || ($number % 10 == 0)) {
            $constName = "self::DOUBLE_DIGIT_" . $number;

            return constant($constName);
        } elseif ($number < 100) {
            $constDecimal = "self::DOUBLE_DIGIT_" . $this->floorDecimals($number) ;

            return  constant($constDecimal).
                    " ".
                    $this->translateSingleDigit(
                        $this->floorDigit($number)
                    );
        }
    }

    private function translateTripleDigit($number)
    {
        if($number % 100 === 0){
            $constName = "self::TRIPLE_DIGIT_$number";
            return constant($constName);
        } else {
            $hundreds = $this->extractHundreds($number);
            $constName = "self::TRIPLE_DIGIT_$hundreds";
            return  constant($constName) .
                    " " .
                    $this->translateDoubleDigitNumber(
                        $this->extractDecimal($number)
                    );
        }
    }

    private function floorDigit($number)
    {
        $string = (string) $number;
        $floored = substr($string, -1, 1);

        return intval($floored);
    }

    private function floorDecimals($number)
    {
        $string = (string) $number;
        $floored = substr($string, -2, 1) . "0";
        return intval($floored);
    }

    private function extractHundreds($number)
    {
        $string = (string) $number;
        $floored = substr($string, -3, 1) . "00";
        return intval($floored);
    }

    private function extractDecimal($number)
    {
        $string = (string) $number;
        return intval(substr($string, 1));
    }

}