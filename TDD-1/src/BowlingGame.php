<?php

class BowlingGame
{

    const MAX_FRAME_SIZE = 2;
    const STRIKE_POINTS = 10;
    const SPARE_POINTS = self::STRIKE_POINTS;

    /**
     * @var array
     * Sample structure:
     * [
     *  [3,6],
     *  [7,1],
     *  [10],
     *  [2,3],
     *  [8,0],
     * ]
     */
    private $frames = [];

    public function roll(int $pins)
    {
        if (empty($this->frames)) {
            $this->frames[] = [];
        }
        $lastFrame = array_pop($this->frames);
        if (!$this->isFullFrame($lastFrame)) {
            $lastFrame[] = $pins;
            $this->frames[] = $lastFrame;
        } else {
            $this->frames[] = $lastFrame;
            $this->frames[] = [$pins];
        }
    }

    public function score()
    {
        $score = 0;
        for ($index = 0; $index < count($this->frames); $index++) {
            $frame = $this->frames[$index];

            if ($this->isStrikeFrame($frame)) {
                if($index >= 10){
                    continue;
                }
                $nextFrame = $this->getNextFrame($index);
                if($this->isStrikeFrame($nextFrame)){
                    $score += self::STRIKE_POINTS + self::STRIKE_POINTS;
                    $nextNextFrame = $this->getNextFrame($index);
                    if($this->isStrikeFrame($nextNextFrame)){
                        $score += self::STRIKE_POINTS;
                    }
                } else {
                    $score += self::STRIKE_POINTS + $this->sumSingleFrameScores($nextFrame);
                }
            } elseif ($this->isSpareFrame($frame)) {
                $nextFrame = $this->getNextFrame($index);
                $score += self::SPARE_POINTS + $nextFrame[0];
            } else {
                $score += $this->sumSingleFrameScores($frame);
            }
        }
        return $score;
    }

    private function getNextFrame(int $currentFrameIndex)
    {
        return $this->frames[$currentFrameIndex + 1];
    }

    private function isSpareFrame(array $frame)
    {
        return  count($frame) == self::MAX_FRAME_SIZE &&
                $frame[0]+$frame[1] === self::STRIKE_POINTS;
    }

    private function sumSingleFrameScores(array $frame)
    {
        $score1 = array_key_exists(0, $frame) ? $frame[0] : 0;
        $score2 = array_key_exists(1, $frame) ? $frame[1] : 0;

        return $score1 + $score2;
    }

    public function isFullFrame(array $frame)
    {
        return count($frame) == self::MAX_FRAME_SIZE || $this->isStrikeFrame($frame);
    }

    public function isStrikeFrame(array $frame)
    {
        return array_key_exists(0, $frame) && $frame[0] == 10;
    }

}