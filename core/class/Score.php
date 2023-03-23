<?php


class Score
{
    public $Loses;
    public $Wins;
    public $Draws;
    public $Rounds;

    public function __construct($loses = 0, $wins = 0, $draws = 0, $rounds = 0)
    {
        $this->Loses = $loses;
        $this->Wins = $wins;
        $this->Draws = $draws;
        $this->Rounds = $rounds;
    }
}