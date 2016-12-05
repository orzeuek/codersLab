<?php

namespace TddB1Tests;

use PHPUnit_Framework_TestCase;
use TddB2Sample\BowlingGame;

/**
 * @author Rafał Orłowski <rafal.orlowski@assertis.co.uk>
 */
class BowlingGameTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var BowlingGame
     */
    private $bowlingGame;

    public function setUp()
    {
        parent::setUp();
        $this->bowlingGame = new BowlingGame();
    }

    public function testAllRollsAre0()
    {
        for ($i=0 ; $i<20 ; $i++) {
            $this->bowlingGame->roll(0);
        }

        $this->assertEquals(0, $this->bowlingGame->score());
    }

    public function testAllRollsAre1()
    {
        for ($i=0 ;  $i<20 ; $i++) {
            $this->bowlingGame->roll(1);
        }

        $this->assertEquals(20, $this->bowlingGame->score());
    }


    public function testFirstStrikeAndNoPoints()
    {
        $this->bowlingGame->roll(10);
        for ($i=0 ;  $i<18 ; $i++) {
            $this->bowlingGame->roll(0);
        }

        $this->assertEquals(10, $this->bowlingGame->score());
    }

    public function testFirstStrikeWithFurtherPoints()
    {
        $this->bowlingGame->roll(10);
        $this->bowlingGame->roll(4);
        $this->bowlingGame->roll(3);
        for ($i=0 ;  $i<16 ; $i++) {
            $this->bowlingGame->roll(0);
        }

        $this->assertEquals(24, $this->bowlingGame->score());
    }

    public function testIsFullFrame()
    {
        $this->assertTrue($this->bowlingGame->isFullFrame([2,5]));
        $this->assertTrue($this->bowlingGame->isFullFrame([1,0]));
        $this->assertTrue($this->bowlingGame->isFullFrame([10]));
        $this->assertTrue($this->bowlingGame->isFullFrame([0,10]));
        $this->assertTrue($this->bowlingGame->isFullFrame([0,0]));

        $this->assertFalse($this->bowlingGame->isFullFrame([0]));
        $this->assertFalse($this->bowlingGame->isFullFrame([]));
        $this->assertFalse($this->bowlingGame->isFullFrame([8]));
    }

    public function testIsStrikeFrame()
    {
        $this->assertTrue($this->bowlingGame->isStrikeFrame([10]));

        $this->assertFalse($this->bowlingGame->isStrikeFrame([0,10]));
        $this->assertFalse($this->bowlingGame->isStrikeFrame([9]));
        $this->assertFalse($this->bowlingGame->isStrikeFrame([5,5]));
    }


    public function testSumFrameScores()
    {
        $this->assertEquals(10, $this->bowlingGame->sumFrameScores([10, 0]));
        $this->assertEquals(10, $this->bowlingGame->sumFrameScores([0, 10]));
        $this->assertEquals(10, $this->bowlingGame->sumFrameScores([5, 5]));
        $this->assertEquals(7, $this->bowlingGame->sumFrameScores([4, 3]));
        $this->assertEquals(0, $this->bowlingGame->sumFrameScores([0,0]));
        $this->assertEquals(10, $this->bowlingGame->sumFrameScores([10]));
    }

    public function testSpare()
    {
        $this->bowlingGame->roll(4);
        $this->bowlingGame->roll(6);
        $this->bowlingGame->roll(4);
        $this->bowlingGame->roll(3);
        for ($i=0 ;  $i<16 ; $i++) {
            $this->bowlingGame->roll(0);
        }

        $this->assertEquals(21, $this->bowlingGame->score());
    }

    public function testIsSpareFrame()
    {
        $this->assertTrue($this->bowlingGame->isSpareFrame([5,5]));
        $this->assertTrue($this->bowlingGame->isSpareFrame([3,7]));
        $this->assertTrue($this->bowlingGame->isSpareFrame([8,2]));
        $this->assertTrue($this->bowlingGame->isSpareFrame([0,10]));

        $this->assertFalse($this->bowlingGame->isSpareFrame([10]));
        $this->assertFalse($this->bowlingGame->isSpareFrame([2,2]));
        $this->assertFalse($this->bowlingGame->isSpareFrame([5,4]));
        $this->assertFalse($this->bowlingGame->isSpareFrame([0,9]));
    }

    public function testPerfectGame()
    {
        for ($i=0 ;  $i<12 ; $i++) {
            $this->bowlingGame->roll(10);
        }

        $this->assertEquals(300, $this->bowlingGame->score());
    }

    public function testIsExtraRoll()
    {
        $this->assertTrue($this->bowlingGame->isExtraRoll(10));
        $this->assertTrue($this->bowlingGame->isExtraRoll(11));
        $this->assertTrue($this->bowlingGame->isExtraRoll(12));
        $this->assertTrue($this->bowlingGame->isExtraRoll(13));

        $this->assertFalse($this->bowlingGame->isExtraRoll(9));
        $this->assertFalse($this->bowlingGame->isExtraRoll(8));
        $this->assertFalse($this->bowlingGame->isExtraRoll(0));
    }
}