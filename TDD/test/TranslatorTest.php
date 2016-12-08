<?php

require __DIR__."/../src/Translator.php";

class TranslatorTest extends \PHPUnit\Framework\TestCase
{

    private $translator;

    protected function setUp()
    {
        parent::setUp();
        $this->translator = new Translator();
    }

    public function tearDown()
    {
        $this->translator = null;
        parent::tearDown();
    }


    public function testOneDigit()
    {
        $this->assertEquals("jeden",$this->translator->translate(1));
        $this->assertEquals("dwa", $this->translator->translate(2));
        $this->assertEquals("trzy", $this->translator->translate(3));
        $this->assertEquals("cztery", $this->translator->translate(4));
        $this->assertEquals("pięć", $this->translator->translate(5));
        $this->assertEquals("sześć", $this->translator->translate(6));
        $this->assertEquals("siedem", $this->translator->translate(7));
        $this->assertEquals("osiem", $this->translator->translate(8));
        $this->assertEquals("dziewięć", $this->translator->translate(9));
        $this->assertEquals("zero", $this->translator->translate(0));
    }
    
    public function testBetween10And20()
    {
        
        $this->assertEquals("dziesięć", $this->translator->translate(10));
        $this->assertEquals("jedenaście", $this->translator->translate(11));
        $this->assertEquals("dwanaście", $this->translator->translate(12));
        $this->assertEquals("trzynaście", $this->translator->translate(13));
        $this->assertEquals("czternaście", $this->translator->translate(14));
        $this->assertEquals("piętnaście", $this->translator->translate(15));
        $this->assertEquals("szesnaście", $this->translator->translate(16));
        $this->assertEquals("siedemnaście", $this->translator->translate(17));
        $this->assertEquals("osiemnaście", $this->translator->translate(18));
        $this->assertEquals("dziewiętnaście", $this->translator->translate(19));
    }

    public function testDoubleDigitGreaterThen19()
    {
        $this->assertEquals("dwadzieścia", $this->translator->translate(20));
        $this->assertEquals("dwadzieścia jeden", $this->translator->translate(21));
        $this->assertEquals("dwadzieścia pięć", $this->translator->translate(25));
        $this->assertEquals("dwadzieścia dziewięć", $this->translator->translate(29));
        $this->assertEquals("czterdzieści dziewięć", $this->translator->translate(49));
        $this->assertEquals("siedemdziesiąt sześć", $this->translator->translate(76));
        $this->assertEquals("dziewięćdziesiąt dziewięć", $this->translator->translate(99));
    }

    public function testTripleDigitNumbers()
    {
        $this->assertEquals("sto", $this->translator->translate(100));
        $this->assertEquals("sześćset", $this->translator->translate(600));
        $this->assertEquals("dziewięćset", $this->translator->translate(900));

        $this->assertEquals("sto jeden", $this->translator->translate(101));
        $this->assertEquals("sto dziesięć", $this->translator->translate(110));
        $this->assertEquals("sto jedenaście", $this->translator->translate(111));
        $this->assertEquals("dziewięćset dziewięćdziesiąt dziewięć", $this->translator->translate(999));
    }



    public function testIsFullTenDigit()
    {
        $this->assertTrue($this->translator->isFullTenDigit(10));
        $this->assertTrue($this->translator->isFullTenDigit(40));
        $this->assertTrue($this->translator->isFullTenDigit(90));

        $this->assertFalse($this->translator->isFullTenDigit(11));
        $this->assertFalse($this->translator->isFullTenDigit(19));
        $this->assertFalse($this->translator->isFullTenDigit(66));
        $this->assertFalse($this->translator->isFullTenDigit(98));
    }

    public function testGetSecondDigitFromNumber()
    {
        $this->assertEquals(2, $this->translator->getSecondDigitFromNumber(21));
        $this->assertEquals(4, $this->translator->getSecondDigitFromNumber(46));
        $this->assertEquals(9, $this->translator->getSecondDigitFromNumber(90));
        $this->assertEquals(7, $this->translator->getSecondDigitFromNumber(76));
    }

    public function testGetSingleDigitFromNumber()
    {
        $this->assertEquals(1, $this->translator->getSingleDigitFromNumber(21));
        $this->assertEquals(6, $this->translator->getSingleDigitFromNumber(46));
        $this->assertEquals(0, $this->translator->getSingleDigitFromNumber(90));
        $this->assertEquals(6, $this->translator->getSingleDigitFromNumber(76));
    }

    public function testIsFullHundred()
    {
        $this->assertTrue($this->translator->isFullHundred(100));
        $this->assertTrue($this->translator->isFullHundred(200));
        $this->assertTrue($this->translator->isFullHundred(300));

        $this->assertFalse($this->translator->isFullHundred(101));
        $this->assertFalse($this->translator->isFullHundred(111));
        $this->assertFalse($this->translator->isFullHundred(199));
        $this->assertFalse($this->translator->isFullHundred(999));
    }

    public function testGetThirdDigitFromNumber()
    {
        $this->assertEquals(1, $this->translator->getThirdDigitFromNumber(121));
        $this->assertEquals(9, $this->translator->getThirdDigitFromNumber(976));
        $this->assertEquals(5, $this->translator->getThirdDigitFromNumber(567));
        $this->assertEquals(4, $this->translator->getThirdDigitFromNumber(414));
    }

}