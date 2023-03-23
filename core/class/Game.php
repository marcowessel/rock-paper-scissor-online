<?php

class Game
{
    public $PlayerChoice;
    public $ComputerChoice;
    public $Winner;

    private const WINNING_MATRIX = [
        ChoiceType::rock => [
            ChoiceType::scissor
        ],
        ChoiceType::scissor => [
            ChoiceType::paper
        ],
        ChoiceType::paper => [
            ChoiceType::rock
        ]
    ];

    function __construct($playerChoice)
    {
        $this->PlayerChoice = $playerChoice;
        $this->ComputerChoice = $this->GetComputerChoice();
    }

    function Start(){
        $this->Winner = $this->GetWinner();
    }

    function GetComputerChoice()
    {
        $choice = rand(1, 3);

        switch ($choice) {
            case 1:
                return ChoiceType::rock;
                break;
            case 2:
                return ChoiceType::paper;
                break;
            case 3:
                return ChoiceType::scissor;
                break;
        }

        return null;
    }

    function GetWinner(): string
    {
        // both choose the same
        if ($this->PlayerChoice == $this->ComputerChoice) {
            return Winner::draw;
        }

        // get all winning scenarios
        $possiblePlayerWins = self::WINNING_MATRIX[$this->PlayerChoice];

        // check if computer choice is a possible win for the player
        return in_array($this->ComputerChoice, $possiblePlayerWins) ? Winner::player : Winner::computer;
    }
}