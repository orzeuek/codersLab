<?php

require __DIR__."/../src/Translator.php";

class TranslatorTest extends \PHPUnit\Framework\TestCase
{

    public function testOneDigit()
    {
        $translator = new Translator();
        $this->assertEquals("jeden",$translator->translate(1));
        $this->assertEquals("dwa", $translator->translate(2));
        $this->assertEquals("trzy", $translator->translate(3));
        $this->assertEquals("cztery", $translator->translate(4));
        $this->assertEquals("pięć", $translator->translate(5));
        $this->assertEquals("sześć", $translator->translate(6));
        $this->assertEquals("siedem", $translator->translate(7));
        $this->assertEquals("osiem", $translator->translate(8));
        $this->assertEquals("dziewięć", $translator->translate(9));
        $this->assertEquals("zero", $translator->translate(0));
    }
    
    public function testBetween10And20()
    {
        $translator = new Translator();
        $this->assertEquals("dziesięć", $translator->translate(10));
        $this->assertEquals("jedenaście", $translator->translate(11));
        $this->assertEquals("dwanaście", $translator->translate(12));
        $this->assertEquals("trzynaście", $translator->translate(13));
        $this->assertEquals("czternaście", $translator->translate(14));
        $this->assertEquals("piętnaście", $translator->translate(15));
        $this->assertEquals("szesnaście", $translator->translate(16));
        $this->assertEquals("siedemnaście", $translator->translate(17));
        $this->assertEquals("osiemnaście", $translator->translate(18));
        $this->assertEquals("dziewiętnaście", $translator->translate(19));
    }

    public function testDoubleDigitGreaterThen19()
    {
        $translator = new Translator();
        $this->assertEquals("dwadzieścia", $translator->translate(20));
        $this->assertEquals("dwadzieścia jeden", $translator->translate(21));
        $this->assertEquals("dwadzieścia pięć", $translator->translate(25));
        $this->assertEquals("dwadzieścia dziewięć", $translator->translate(29));
        $this->assertEquals("czterdzieści dziewięć", $translator->translate(49));
        $this->assertEquals("siedemdziesiąt sześć", $translator->translate(76));
        $this->assertEquals("dziewięćdziesiąt dziewięć", $translator->translate(99));
    }

    public function testTripleDigitNumbers()
    {
        $translator = new Translator();
        $this->assertEquals("sto", $translator->translate(100));
        $this->assertEquals("sześćset", $translator->translate(600));
        $this->assertEquals("dziewięćset", $translator->translate(900));

        $this->assertEquals("sto jeden", $translator->translate(101));
        $this->assertEquals("sto dziesięć", $translator->translate(110));
        $this->assertEquals("sto jedenaście", $translator->translate(111));
        $this->assertEquals("dziewięćset dziewięćdziesiąt dziewięć", $translator->translate(999));
    }



    public function testIsFullTenDigit()
    {
        $translator = new Translator();
        $this->assertTrue($translator->isFullTenDigit(10));
        $this->assertTrue($translator->isFullTenDigit(40));
        $this->assertTrue($translator->isFullTenDigit(90));

        $this->assertFalse($translator->isFullTenDigit(11));
        $this->assertFalse($translator->isFullTenDigit(19));
        $this->assertFalse($translator->isFullTenDigit(66));
        $this->assertFalse($translator->isFullTenDigit(98));
    }

    public function testGetSecondDigitFromNumber()
    {
        $translator = new Translator();
        $this->assertEquals(2, $translator->getSecondDigitFromNumber(21));
        $this->assertEquals(4, $translator->getSecondDigitFromNumber(46));
        $this->assertEquals(9, $translator->getSecondDigitFromNumber(90));
        $this->assertEquals(7, $translator->getSecondDigitFromNumber(76));
    }

    public function testGetSingleDigitFromNumber()
    {
        $translator = new Translator();
        $this->assertEquals(1, $translator->getSingleDigitFromNumber(21));
        $this->assertEquals(6, $translator->getSingleDigitFromNumber(46));
        $this->assertEquals(0, $translator->getSingleDigitFromNumber(90));
        $this->assertEquals(6, $translator->getSingleDigitFromNumber(76));
    }

    public function testIsFullHundred()
    {
        $translator = new Translator();
        $this->assertTrue($translator->isFullHundred(100));
        $this->assertTrue($translator->isFullHundred(200));
        $this->assertTrue($translator->isFullHundred(300));

        $this->assertFalse($translator->isFullHundred(101));
        $this->assertFalse($translator->isFullHundred(111));
        $this->assertFalse($translator->isFullHundred(199));
        $this->assertFalse($translator->isFullHundred(999));
    }

    public function testGetThirdDigitFromNumber()
    {
        $translator = new Translator();
        $this->assertEquals(1, $translator->getThirdDigitFromNumber(121));
        $this->assertEquals(9, $translator->getThirdDigitFromNumber(976));
        $this->assertEquals(5, $translator->getThirdDigitFromNumber(567));
        $this->assertEquals(4, $translator->getThirdDigitFromNumber(414));
    }

}