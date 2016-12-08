<?php

require_once __DIR__."/../src/BowlingGame.php";

use PHPUnit\Framework\TestCase;

class BowlingGameTest extends TestCase
{

    public function test0points()
    {
        $bowlingGame = new BowlingGame();
        for ($i=0; $i<20 ; $i++){
            $bowlingGame->roll(0);
        }
        $this->assertEquals(0,$bowlingGame->score());
    }

    public function testAllRollsAre1Point()
    {
        $bowlingGame = new BowlingGame();
        for ($i=0; $i<20 ; $i++){
            $bowlingGame->roll(1);
        }
        $this->assertEquals(20,$bowlingGame->score());
    }

    public function testFirstStrikeAndThenAllZeros()
    {
        $bowlingGame = new BowlingGame();
        $bowlingGame->roll(10);
        for ($i=0; $i<18 ; $i++){
            $bowlingGame->roll(0);
        }
        $this->assertEquals(10, $bowlingGame->score());
    }

    public function testFirstStrikeThenSomePointsThenZeros()
    {
        $bowlingGame = new BowlingGame();
        $bowlingGame->roll(10);
        $bowlingGame->roll(3);
        $bowlingGame->roll(4);
        for ($i=0; $i<16 ; $i++){
            $bowlingGame->roll(0);
        }
        $this->assertEquals(24, $bowlingGame->score());
    }

    public function testSpareRoll()
    {
        $bowlingGame = new BowlingGame();
        $bowlingGame->roll(4);
        $bowlingGame->roll(6);
        $bowlingGame->roll(4);
        for ($i=0; $i<17 ; $i++){
            $bowlingGame->roll(0);
        }
        $this->assertEquals(18, $bowlingGame->score());
    }

    public function testPerfectGame()
    {
        $bowlingGame = new BowlingGame();
        for ($i=0; $i<12 ; $i++){
            $bowlingGame->roll(10);
        }
        $this->assertEquals(300, $bowlingGame->score());
    }

    public function testIsFullFrame()
    {
        $bowlingGame = new BowlingGame();
        $this->assertFalse($bowlingGame->isFullFrame([]));
        $this->assertFalse($bowlingGame->isFullFrame([1]));
        $this->assertTrue($bowlingGame->isFullFrame([1,2]));
        $this->assertTrue($bowlingGame->isFullFrame([10]));
    }

    public function testIsStrikeFrame()
    {
        $bowlingGame = new BowlingGame();
        $this->assertFalse($bowlingGame->isStrikeFrame([]));
        $this->assertFalse($bowlingGame->isStrikeFrame([3,4]));
        $this->assertFalse($bowlingGame->isStrikeFrame([5,5]));

        $this->assertTrue($bowlingGame->isStrikeFrame([10]));
    }

}