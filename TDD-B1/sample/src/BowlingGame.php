<?php
namespace TddB2Sample;

/**
 * @author Rafał Orłowski <rafal.orlowski@assertis.co.uk>
 */
class BowlingGame
{

    const STRIKE_SCORE = 10;

    /**
     * already thrown frames. Sample structure:
     * [
     *  [5,6],
     *  [7,6],
     *  [5,9],
     *  [10,6],
     *  [5,6],
     *  [5,7],
     *  [3,6],
     *  [5,2],
     *  [5,2],
     * ]
     * @var array
     */
    private $frames = [];

    /**
     * @param int $pins
     */
    public function roll(int $pins)
    {
        $lastFrame = $this->popLastFrame();

        if($this->isFullFrame($lastFrame)){
            $this->frames[] = $lastFrame;
            $this->frames[] = [$pins];
            return;
        }

        $lastFrame[] = $pins;
        $this->frames[] = $lastFrame;
    }

    private function popLastFrame()
    {
        $lastFrame = array_pop($this->frames);
        return $lastFrame ?? [];
    }

    public function isStrikeFrame(array $frame): bool
    {
        return isset($frame[0]) && $frame[0] == self::STRIKE_SCORE;
    }

    public function isSpareFrame(array $frame)
    {
        return
            count($frame) === 2 &&
            $frame[0] + $frame[1] == self::STRIKE_SCORE;
    }

    public function isFullFrame(array $frame): bool
    {
        return count($frame) === 2 || $this->isStrikeFrame($frame);
    }

    /**
     * @return int
     */
    public function score(): int
    {
        $pointsSum = 0;
        for($i=0 ; $i < count($this->frames) ; $i++){
            $frame = $this->frames[$i];

            if($this->isExtraRoll($i)){
                continue;
            }

            if($this->isStrikeFrame($frame)){
                $nextFrame = $this->frames[$i+1];
                $pointsSum += $this->sumFrameScores($frame) + $this->sumFrameScores($nextFrame);
                if($this->isStrikeFrame($nextFrame)){
                    $nextNextFrame = $this->frames[$i+2];
                    $pointsSum += $nextNextFrame[0];
                }
            } elseif ($this->isSpareFrame($frame)){
                $nextFrame = $this->frames[$i+1];
                $pointsSum += $this->sumFrameScores($frame) + $nextFrame[0];
            } else {
                $pointsSum += $this->sumFrameScores($frame);
            }

        }

        return $pointsSum;
    }

    /**
     * @param $rollIndex
     *  Number of roll. WARNING ! Keep in mind that 1st roll have "0" index, 2nd is "1"
     *  3rd is "2" etc.
     * @return bool
     */
    public function isExtraRoll($rollIndex)
    {
        return $rollIndex >= 10;
    }

    /**
     * @param array $frame
     * @return mixed
     */
    public function sumFrameScores(array $frame)
    {
        $pin0 = $frame[0];
        $pin1 = isset($frame[1]) ? $frame[1] : 0;

        return $pin0 + $pin1;
    }

}