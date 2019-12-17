<?php

class BottlesSong
{
    private $from;
    private $to;

    public function from(int $fromHowManyBottles) : BottlesSong
    {
        $this->from = $fromHowManyBottles;

        return $this;
    }

    public function to(int $toHowManyBottles) : BottlesSong
    {
        $this->to = $toHowManyBottles;

        return $this;
    }

    public function sing() : string
    {
        if ($this->cannotDetermineWhereToStart()) {
            throw new \Exceptions\SongCannotStartWithoutFrom('You should decide where to start!');
        }

        if ($this->shouldPlayOnlyOneVerse()) {
            return $this->verse($this->from);
        }

        return $this->prepareRangeOfVerses();
    }

    private function cannotDetermineWhereToStart() : bool
    {
        return is_null($this->from);
    }

    private function shouldPlayOnlyOneVerse() : bool
    {
        return is_null($this->to);
    }

    private function prepareRangeOfVerses() : string
    {
        return implode("". PHP_EOL ."". PHP_EOL ."", array_map(function($howManyBottlesThisTime) {
            return $this->verse($howManyBottlesThisTime);
        }, range($this->from, $this->to)));
    }

    private function verse(int $howManyBottles) : string
    {
        $bottlesLeft = $howManyBottles - 1;

        switch ($howManyBottles) {
            case 2:
                return "2 bottles of beer on the wall, 2 bottles of beer.". PHP_EOL ."Take one down and pass it around, 1 bottle of beer on the wall.";
            case 1:
                return "1 bottle of beer on the wall, 1 bottle of beer.". PHP_EOL ."Take it down and pass it around, no more bottles of beer on the wall.";
            case 0:
                return "No more bottles of beer on the wall, no more bottles of beer.". PHP_EOL ."Go to the store and buy some more, 99 bottles of beer on the wall.";
            default: 
                return "{$howManyBottles} bottles of beer on the wall, {$howManyBottles} bottles of beer.". PHP_EOL ."Take one down and pass it around, {$bottlesLeft} bottles of beer on the wall.";
        }
    }
}
