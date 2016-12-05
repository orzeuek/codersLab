<?php
namespace TddTests;

use TddA1Sample\NumbersTranslator;

/**
 * @author Rafał Orłowski <rafal.orlowski@assertis.co.uk>
 */
class NumbersTranslatorTest extends \PHPUnit_Framework_TestCase
{

    private $objectUnderTest;

    public function setUp()
    {
        parent::setUp();
        $this->objectUnderTest = new NumbersTranslator();
    }

    public function tearDown()
    {
        parent::tearDown();
        $this->objectUnderTest = null;
    }

    public function testSingleDigitNumbers()
    {
        $this->assertEquals("jeden", $this->objectUnderTest->translate(1));
        $this->assertEquals("dwa", $this->objectUnderTest->translate(2));
        $this->assertEquals("trzy", $this->objectUnderTest->translate(3));
        $this->assertEquals("cztery", $this->objectUnderTest->translate(4));
        $this->assertEquals("pięć", $this->objectUnderTest->translate(5));
        $this->assertEquals("sześć", $this->objectUnderTest->translate(6));
        $this->assertEquals("siedem", $this->objectUnderTest->translate(7));
        $this->assertEquals("osiem", $this->objectUnderTest->translate(8));
        $this->assertEquals("dziewięć", $this->objectUnderTest->translate(9));
        $this->assertEquals("zero", $this->objectUnderTest->translate(0));
    }

    public function testDoubleDigitNumbers()
    {
        $this->assertEquals("dziesięć", $this->objectUnderTest->translate(10));
        $this->assertEquals("jedenaście", $this->objectUnderTest->translate(11));
        $this->assertEquals("dwanaście", $this->objectUnderTest->translate(12));
        $this->assertEquals("trzynaście", $this->objectUnderTest->translate(13));
        $this->assertEquals("czternaście", $this->objectUnderTest->translate(14));
        $this->assertEquals("piętnaście", $this->objectUnderTest->translate(15));
        $this->assertEquals("szesnaście", $this->objectUnderTest->translate(16));
        $this->assertEquals("siedemnaście", $this->objectUnderTest->translate(17));
        $this->assertEquals("osiemnaście", $this->objectUnderTest->translate(18));
        $this->assertEquals("dziewiętnaście", $this->objectUnderTest->translate(19));

        $this->assertEquals("dwadzieścia", $this->objectUnderTest->translate(20));
        $this->assertEquals("dwadzieścia jeden", $this->objectUnderTest->translate(21));
        $this->assertEquals("dwadzieścia sześć", $this->objectUnderTest->translate(26));
        $this->assertEquals("trzydzieści", $this->objectUnderTest->translate(30));
        $this->assertEquals("trzydzieści siedem", $this->objectUnderTest->translate(37));
        $this->assertEquals("czterdzieści", $this->objectUnderTest->translate(40));
        $this->assertEquals("czterdzieści dwa", $this->objectUnderTest->translate(42));
        $this->assertEquals("dziewięćdziesiąt", $this->objectUnderTest->translate(90));
        $this->assertEquals("dziewięćdziesiąt dziewięć", $this->objectUnderTest->translate(99));
    }

    public function testTripleDigitNumbers()
    {
        $this->assertEquals("sto", $this->objectUnderTest->translate(100));
        $this->assertEquals("sto dziesięć", $this->objectUnderTest->translate(110));
        $this->assertEquals("sto jedenaście", $this->objectUnderTest->translate(111));
        $this->assertEquals("dwieście dwadzieścia dwa", $this->objectUnderTest->translate(222));
        $this->assertEquals("dziewięćset dziewięćdziesiąt dziewięć", $this->objectUnderTest->translate(999));
    }

}